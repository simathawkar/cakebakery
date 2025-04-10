<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>About Us</h3>
            <p>We are a premium cake delivery service, offering a wide range of delicious cakes for all occasions.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="Index.php">Home</a></li>
                <li><a href="#cake">Category Cakes</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#about">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact Info</h3>
            <ul>
                <li>Email: info@cakeshop.com</li>
                <li>Phone: +123 456 7890</li>
                <li>Address: 123 Cake Street, Sweet City</li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Follow Us</h3>
            <ul class="social-links">
                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2023 Online Cake Order. All rights reserved.</p>
    </div>
    <div class="credite text-center">
        Designed By <a href="#"><span>Mayuri Wanjari</span></a>
    </div>
</footer>

<style>
.footer {
    background-color: #1a1817 !important;
    color: white;
    padding: 40px 0;
    margin-top: 40px;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-section {
    flex: 1;
    min-width: 200px;
    margin-bottom: 20px;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 15px;
}

.footer-section p, .footer-section ul {
    font-size: 14px;
    line-height: 1.6;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
}

.footer-section ul li a:hover {
    text-decoration: underline;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-links li {
    list-style: none;
}

.social-links li a {
    color: #fff;
    font-size: 24px;
    transition: color 0.3s ease;
}

.social-links li a:hover {
    color: #ff6f61;
}

.footer-bottom {
    text-align: center;
    padding: 20px 0;
    border-top: 1px solid #444;
    margin-top: 20px;
}

.footer-bottom p {
    margin: 0;
    font-size: 14px;
}

.credite.text-center {
    text-align: center;
    padding: 10px 0;
    font-size: 14px;
}

.credite.text-center a {
    color: #fff;
    text-decoration: none;
}

.credite.text-center a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .footer-section {
        margin-bottom: 30px;
    }

    .social-links {
        justify-content: center;
    }
    
    #about .row {
        flex-direction: column;
    }

    #about .col-md-6 {
        width: 100%;
        padding: 10px 20px;
    }
}
</style>