    </main>
    
    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-wave">
            <svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z" fill="rgba(68, 38, 103, 0.1)"/>
            </svg>
        </div>
        
        <div class="footer-content">
            <div class="footer-info">
                <div class="creator-info">
                    <div class="creator-avatar">
                        <span>🎨</span>
                    </div>
                    <div class="creator-details">
                        <strong><a href="https://noemiepulido-graphiste.com/" target="_blank" rel="noopener" class="creator-link">Créé par Noémie Pulido</a></strong>
                        <p>Graphiste créative à Bordeaux</p>
                    </div>
                </div>
                
                <div class="developer-info">
                    <div class="developer-avatar">
                        <span>💻</span>
                    </div>
                    <div class="developer-details">
                        <strong><a href="https://remikel.fr/" target="_blank" rel="noopener" class="developer-link">et développé par Rémi Mikel</a></strong>
                        <p>Développeur et maître IA</p>
                    </div>
                </div>
                
                <div class="social-links">
                    <a href="https://www.instagram.com/noemie_pulido/" target="_blank" rel="noopener" class="social-link">
                        <span class="social-icon">📸</span>
                        Instagram
                    </a>
                    <a href="mailto:hello@noemie-pulido.fr" class="social-link">
                        <span class="social-icon">📧</span>
                        Contact
                    </a>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="copyright">© <?= date('Y') ?> • Fait avec ❤️ à Bordeaux</p>
            </div>
        </div>
    </footer>
    
    <!-- Enhanced JavaScript -->
    <script src="js/enhanced-interactions.js" defer></script>
    
    <style>
    .main-footer {
        margin-top: auto;
        position: relative;
        background: transparent;
        padding: 0;
    }
    
    .footer-wave {
        width: 100%;
        height: 60px;
        margin-bottom: -1px;
    }
    
    .footer-wave svg {
        width: 100%;
        height: 100%;
    }
    
    .footer-content {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(245, 183, 19, 0.1));
        backdrop-filter: blur(10px);
        padding: var(--spacing-lg) var(--spacing-md);
        border-top: 1px solid rgba(68, 38, 103, 0.2);
    }
    
    .footer-info {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: var(--spacing-md);
    }
    
    .creator-info,
    .developer-info {
        display: flex;
        align-items: center;
        gap: var(--spacing-md);
        background: rgba(255, 255, 255, 0.9);
        padding: var(--spacing-md);
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(68, 38, 103, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .creator-avatar,
    .developer-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .creator-details strong,
    .developer-details strong {
        color: var(--primary-color);
        font-size: 1.1rem;
        display: block;
    }
    
    .creator-link,
    .developer-link {
        color: inherit;
        text-decoration: none;
    }
    
    .creator-details p,
    .developer-details p {
        color: #666;
        font-size: 0.9rem;
        margin: 0;
        opacity: 0.8;
    }
    
    .social-links {
        display: flex;
        gap: var(--spacing-md);
        flex-wrap: wrap;
    }
    
    .social-link {
        display: flex;
        align-items: center;
        gap: var(--spacing-xs);
        color: var(--primary-color);
        text-decoration: none;
        padding: var(--spacing-sm) var(--spacing-md);
        background: rgba(255, 255, 255, 0.7);
        border-radius: 25px;
        transition: var(--transition);
        font-weight: 500;
        font-size: 0.9rem;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .social-link:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(68, 38, 103, 0.15);
        color: var(--accent-color);
    }
    
    .social-icon {
        font-size: 1.1rem;
    }
    
    .footer-bottom {
        text-align: center;
        margin-top: var(--spacing-lg);
        padding-top: var(--spacing-md);
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .copyright {
        color: rgba(68, 38, 103, 0.8);
        font-size: 0.85rem;
        margin: 0;
        font-weight: 600;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .footer-info {
            flex-direction: column;
            text-align: center;
        }
        
        .creator-info,
        .developer-info {
            flex-direction: column;
            text-align: center;
            border-radius: var(--border-radius);
            padding: var(--spacing-lg);
        }
        
        .social-links {
            justify-content: center;
        }
        
        .social-link {
            font-size: 0.8rem;
            padding: var(--spacing-sm);
        }
    }
    
    @media (max-width: 480px) {
        .social-links {
            flex-direction: column;
            width: 100%;
        }
        
        .social-link {
            justify-content: center;
        }
    }
    </style>
</body>
</html>