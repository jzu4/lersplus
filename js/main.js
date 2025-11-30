// js/main.js

document.addEventListener('DOMContentLoaded', () => {

    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartLink = document.querySelector('.nav-links a[href="cart.html"]');
    
    // عربة التسوق ستكون مؤقتة في متصفح المستخدم (Session Storage)
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    // تحديث عدد المنتجات في الهيدر
    function updateCartCount() {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartLink.textContent = `العربة (${totalItems})`;
    }

    // إضافة منتج للعربة
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price'));

            const existingProduct = cart.find(item => item.name === name);

            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                cart.push({ name, price, quantity: 1 });
            }

            sessionStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();

            // تغيير نص الزر مؤقتاً
            const originalText = button.textContent;
            button.textContent = 'تمت الإضافة!';
            button.style.background = '#28a745';
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '';
            }, 1500);
        });
    });

    // استدعاء الدالة عند تحميل الصفحة لتحديث العداد
    updateCartCount();
});
