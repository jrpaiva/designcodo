<footer id="contato" class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6 text-center">
             <p>&copy; <?php echo date('Y'); ?> Design Informática. Todos os direitos reservados.</p>
             <p class="text-gray-400 text-sm mt-2">Av. Augusto Teixeira, N°2284 - Centro - Codó, MA | 📞 (99) 9119-9793</p>
        </div>
    </footer>
    
    <div id="feedbackModal" class="fixed inset-0 z-[999] hidden flex items-center justify-center p-4">
        <div id="feedbackModalOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300 ease-out opacity-0"></div>
        <div id="feedbackModalContent" class="relative bg-white rounded-xl shadow-xl w-full max-w-sm text-center p-8 transform scale-95 opacity-0 transition-all duration-300 ease-out">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-5">
                <svg class="h-10 w-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 id="feedbackModalTitle" class="text-2xl font-bold text-gray-800">Inscrição Recebida!</h3>
            <p id="feedbackModalMessage" class="text-gray-600 mt-3">Obrigado! Entraremos em contato em breve.</p>
            <button id="feedbackModalClose" class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold">Fechar</button>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true, offset: 50 });

        // --- LÓGICA DO MENU ---
        const headerState = { isMobileMenuOpen: false };
        const header = document.getElementById('modernHeader');
        const modernMobileMenuBtn = document.getElementById('modernMobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuSidebar = document.getElementById('menuSidebar');
        const closeMobileMenu = document.getElementById('fechar-menu-btn');
        const menuOverlay = document.getElementById('menuOverlay');
        const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
        
        const openMenu = () => {
            if (!mobileMenu || !menuSidebar || !header) return;
            header.classList.add('hidden');
            mobileMenu.classList.remove('hidden');
            modernMobileMenuBtn.classList.add('active');
            requestAnimationFrame(() => {
                menuSidebar.style.transform = 'translateX(0)';
            });
            document.body.style.overflow = 'hidden';
        };

        const closeMenu = () => {
            if (!mobileMenu || !menuSidebar || !header) return;
            header.classList.remove('hidden');
            modernMobileMenuBtn.classList.remove('active');
            menuSidebar.style.transform = 'translateX(100%)';
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        };

        if(modernMobileMenuBtn) modernMobileMenuBtn.addEventListener('click', openMenu);
        if(closeMobileMenu) closeMobileMenu.addEventListener('click', closeMenu);
        if(menuOverlay) menuOverlay.addEventListener('click', closeMenu);
        
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMenu();
            }
        });
        
        // --- LÓGICA DO FORMULÁRIO E MODAL ---
        const feedbackModal = document.getElementById('feedbackModal');
        if(feedbackModal) {
            const feedbackModalOverlay = document.getElementById('feedbackModalOverlay');
            const feedbackModalContent = document.getElementById('feedbackModalContent');
            const feedbackModalClose = document.getElementById('feedbackModalClose');

            function openFeedbackModal(title, message) {
                document.getElementById('feedbackModalTitle').textContent = title;
                document.getElementById('feedbackModalMessage').textContent = message;
                feedbackModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                requestAnimationFrame(() => {
                    feedbackModalOverlay.style.opacity = '1';
                    feedbackModalContent.style.opacity = '1';
                    feedbackModalContent.style.transform = 'scale(1)';
                });
            }

            function closeFeedbackModal() {
                feedbackModalOverlay.style.opacity = '0';
                feedbackModalContent.style.opacity = '0';
                feedbackModalContent.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    feedbackModal.classList.add('hidden');
                    if (!mobileMenu.classList.contains('hidden')) {
                         document.body.style.overflow = 'hidden';
                    } else {
                         document.body.style.overflow = '';
                    }
                }, 300);
            }
            
            if(feedbackModalClose) feedbackModalClose.addEventListener('click', closeFeedbackModal);
            if(feedbackModalOverlay) feedbackModalOverlay.addEventListener('click', closeFeedbackModal);
        }

        const interesseForm = document.getElementById('interesseForm');
        if(interesseForm) {
            interesseForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                submitButton.textContent = 'Enviando...';
                submitButton.disabled = true;
                
                const formData = new FormData(this);
                try {
                    const response = await fetch('salvar_form.php', { method: 'POST', body: formData });
                    if (!response.ok) throw new Error('HTTP error');
                    const nome = formData.get('nome').split(' ')[0];
                    openFeedbackModal('Inscrição Recebida!', `Obrigado, ${nome}! Entraremos em contato em breve.`);
                    this.reset();
                } catch (error) {
                    console.error('Erro no envio:', error);
                    openFeedbackModal('Erro no Envio', 'Não foi possível enviar seus dados. Tente novamente.');
                } finally {
                    submitButton.textContent = originalText;
                    submitButton.disabled = false;
                }
            });
        }
    });
    </script>
</body>
</html>