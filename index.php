<?php
// هذا الملف (index.php) يعتبر واجهة الـ Frontend فقط
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>RivesDev | الدفع الآمن</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap');

:root {
  --bg-color: #030305;
  --card-bg: rgba(20, 20, 23, 0.6);
  --border-color: rgba(255, 255, 255, 0.08);
  --primary-red: #ef4444;
  --primary-red-glow: rgba(239, 68, 68, 0.5);
  --text-main: #ffffff;
  --text-muted: #94a3b8;
  --input-bg: rgba(0, 0, 0, 0.3);
}

* { box-sizing: border-box; margin: 0; padding: 0; outline: none; -webkit-tap-highlight-color: transparent; }
body { font-family: 'Tajawal', sans-serif; background-color: var(--bg-color); background-image: radial-gradient(circle at 50% 0%, rgba(239, 68, 68, 0.15), transparent 50%); min-height: 100vh; display: flex; justify-content: center; align-items: center; color: var(--text-main); padding: 24px; }

input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
input[type=number] { -moz-appearance: textfield; }

.payment-container { width: 100%; max-width: 520px; background: var(--card-bg); backdrop-filter: blur(25px); border: 1px solid var(--border-color); border-radius: 32px; padding: 40px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7); }
.header-section { text-align: center; margin-bottom: 40px; }
.brand-logo { width: 64px; height: 64px; background: linear-gradient(135deg, #ef4444, #b91c1c); border-radius: 20px; display: inline-flex; justify-content: center; align-items: center; margin-bottom: 20px; box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4); }
.brand-logo svg { width: 32px; height: 32px; color: white; }
.app-title { font-size: 28px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 8px; color: white; }
.app-subtitle { font-size: 14px; color: var(--text-muted); font-weight: 500; }

.section-label { font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; display: block; }
.services-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }

.service-card { position: relative; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); border-radius: 20px; padding: 20px; cursor: pointer; transition: all 0.3s; display: flex; flex-direction: column; justify-content: space-between; height: 110px; }
.service-card:hover { background: rgba(255, 255, 255, 0.06); transform: translateY(-2px); border-color: rgba(239, 68, 68, 0.3); }
.service-card.active { background: linear-gradient(145deg, rgba(239, 68, 68, 0.1), rgba(185, 28, 28, 0.05)); border-color: var(--primary-red); box-shadow: 0 0 0 1px var(--primary-red); }
.service-card.active .service-icon { color: var(--primary-red); transform: scale(1.1); }
.service-card.active .service-price { color: #fff; }

.service-top { display: flex; align-items: center; gap: 10px; }
.service-icon { width: 24px; height: 24px; color: var(--text-muted); transition: 0.3s; }
.service-name { font-size: 15px; font-weight: 700; color: #e2e8f0; }
.service-price { font-size: 18px; font-weight: 800; color: var(--primary-red); }
.custom-amount-card { grid-column: span 2; flex-direction: row; align-items: center; height: 64px; padding: 0 24px; }

#customInputWrapper { overflow: hidden; max-height: 0; opacity: 0; transition: all 0.4s ease; margin-bottom: 0; }
#customInputWrapper.show { max-height: 80px; opacity: 1; margin-bottom: 24px; }
.custom-field, .text-input { width: 100%; background: var(--input-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 16px; color: white; font-family: inherit; font-size: 15px; transition: 0.3s; }
.text-input:focus, .custom-field:focus { border-color: var(--primary-red); box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1); background: rgba(0, 0, 0, 0.5); }

.form-group { margin-bottom: 20px; position: relative; }
.input-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px; }

.coupon-section { background: rgba(255,255,255,0.03); border: 1px dashed rgba(255,255,255,0.1); border-radius: 16px; padding: 16px; display: flex; gap: 10px; margin-bottom: 24px; }
.coupon-input { flex: 1; border: none; background: transparent; color: #fff; font-size: 14px; }
.coupon-btn { background: rgba(255,255,255,0.1); border: none; padding: 8px 16px; border-radius: 10px; color: white; font-weight: bold; cursor: pointer; font-size: 12px; transition: 0.2s; }
.coupon-btn:hover { background: var(--primary-red); }
.price-summary { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 14px; color: var(--text-muted); }
.final-price { font-size: 20px; color: #fff; font-weight: 800; }

.pay-button { width: 100%; padding: 18px; border: none; border-radius: 16px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; font-family: inherit; font-size: 16px; font-weight: 800; cursor: pointer; box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4); transition: transform 0.2s; display: flex; justify-content: center; align-items: center; gap: 10px; }
.pay-button:hover:not(:disabled) { transform: translateY(-2px); }
.pay-button:disabled { opacity: 0.6; cursor: not-allowed; background: #334155; }

.status-msg { margin-top: 20px; text-align: center; font-size: 13px; min-height: 20px; opacity: 0; transition: opacity 0.3s; }
.status-msg.visible { opacity: 1; }
.error-msg { color: #fca5a5; background: rgba(239, 68, 68, 0.1); padding: 10px; border-radius: 10px; display: inline-block; }
.loading-msg { color: #f87171; }
.coupon-msg { font-size: 12px; margin-top: 5px; height: 15px; }
.coupon-success { color: #4ade80; }
.coupon-error { color: #f87171; }

@media (max-width: 480px) {
  .services-grid { grid-template-columns: 1fr; }
  .custom-amount-card { grid-column: span 1; }
  .payment-container { padding: 24px; border-radius: 24px; }
}
</style>
</head>

<body>

<div class="payment-container">
  <div class="header-section">
    <div class="brand-logo">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
    </div>
    <h1 class="app-title">RivesDev</h1>
    <p class="app-subtitle">بوابة الدفع الإلكتروني الآمنة</p>
  </div>

  <span class="section-label">اختر الخدمة</span>

  <div class="services-grid">
    <div class="service-card active" onclick="selectService('تأسيس تطبيق TV', 150, this)">
      <div class="service-top">
        <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="15" x="2" y="7" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
        <span class="service-name">تأسيس TV</span>
      </div>
      <span class="service-price">150 ر.س</span>
    </div>

    <div class="service-card" onclick="selectService('تحديث التطبيق', 50, this)">
      <div class="service-top">
        <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 21h5v-5"/></svg>
        <span class="service-name">تحديث التطبيق</span>
      </div>
      <span class="service-price">50 ر.س</span>
    </div>

    <div class="service-card custom-amount-card" onclick="selectCustom(this)">
      <div class="service-top">
        <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
        <span class="service-name">مبلغ محدد</span>
      </div>
      <span class="service-price">تحديد السعر</span>
    </div>
  </div>

  <div id="customInputWrapper">
    <input type="number" id="customAmount" class="custom-field" placeholder="أدخل المبلغ هنا (ر.س)">
  </div>

  <div class="coupon-section">
    <input type="text" id="couponCode" class="coupon-input" placeholder="كود الخصم (اختياري)">
    <button class="coupon-btn" onclick="applyCoupon()">تطبيق</button>
  </div>
  <div id="couponMsg" class="coupon-msg"></div>

  <div class="price-summary">
    <span>المبلغ الإجمالي:</span>
    <span class="final-price" id="totalDisplay">150 ر.س</span>
  </div>

  <div class="form-group">
    <label class="input-label">رقم الجوال</label>
    <input type="tel" id="phone" class="text-input" placeholder="05xxxxxxxx">
  </div>

  <div class="form-group">
    <label class="input-label">البريد الإلكتروني</label>
    <input type="email" id="email" class="text-input" placeholder="name@example.com">
  </div>

  <button id="payBtn" class="pay-button">
    <span>دفع آمن</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
  </button>

  <div id="status" class="status-msg"></div>
</div>

<script>
let currentAmount = 150;
let currentDesc = "تأسيس تطبيق TV";
let isCustom = false;
let discountAmount = 0;

function selectService(desc, price, el) {
  isCustom = false; currentDesc = desc; currentAmount = price;
  document.getElementById("customInputWrapper").classList.remove("show");
  updateSelection(el); resetCalculation();
}
function selectCustom(el) {
  isCustom = true; currentDesc = "مبلغ محدد"; currentAmount = 0;
  document.getElementById("customInputWrapper").classList.add("show");
  setTimeout(() => document.getElementById("customAmount").focus(), 100);
  updateSelection(el); resetCalculation();
}
function updateSelection(activeEl) {
  document.querySelectorAll(".service-card").forEach(card => card.classList.remove("active"));
  activeEl.classList.add("active");
}
function resetCalculation() {
  discountAmount = 0;
  document.getElementById("couponMsg").innerText = "";
  document.getElementById("couponCode").value = "";
  updatePriceDisplay();
}
function updatePriceDisplay() {
  let final = currentAmount - discountAmount;
  if (final < 0) final = 0;
  let displayHTML = final + " ر.س";
  if (discountAmount > 0) displayHTML += ` <span style="text-decoration: line-through; opacity: 0.5; font-size: 12px; margin-right: 5px;">(${currentAmount})</span>`;
  document.getElementById("totalDisplay").innerHTML = displayHTML;
}
document.getElementById("customAmount").addEventListener('input', (e) => {
  if(isCustom) { currentAmount = Number(e.target.value); updatePriceDisplay(); }
});
async function applyCoupon() {
  const code = document.getElementById("couponCode").value.trim();
  const msgEl = document.getElementById("couponMsg");
  if (!code) return;
  msgEl.className = "coupon-msg"; msgEl.innerText = "جاري التحقق...";
  try {
    const res = await fetch("coupons.php", { method: "POST", headers: {"Content-Type":"application/json"}, body: JSON.stringify({ code: code }) });
    const data = await res.json();
    if (data.success) {
      discountAmount = data.discount;
      msgEl.className = "coupon-msg coupon-success"; msgEl.innerText = "✓ " + data.message;
      updatePriceDisplay();
    } else {
      discountAmount = 0; msgEl.className = "coupon-msg coupon-error"; msgEl.innerText = data.message;
      updatePriceDisplay();
    }
  } catch (e) { msgEl.className = "coupon-msg coupon-error"; msgEl.innerText = "خطأ في الاتصال"; }
}
document.getElementById("payBtn").onclick = async () => {
  const status = document.getElementById("status");
  const phone = document.getElementById("phone").value.trim();
  const email = document.getElementById("email").value.trim();
  if (isCustom) {
    const customVal = Number(document.getElementById("customAmount").value);
    if (!customVal || customVal <= 0) { showError("الرجاء إدخال مبلغ صحيح"); return; }
    currentAmount = customVal;
  }
  const finalPrice = currentAmount - discountAmount;
  if (finalPrice <= 0) { showError("المبلغ الإجمالي صفر، لا يمكن إتمام الطلب"); return; }
  if (!/^[0-9]{12}$/.test(phone)) { showError("رقم الجوال يجب أن يكون 12 رقم"); return; }
  if (!email || !email.includes('@')) { showError("البريد الإلكتروني غير صحيح"); return; }
  showLoading(); document.getElementById("payBtn").disabled = true;
  try {
    const res = await fetch("payment.php", { method: "POST", headers: {"Content-Type":"application/json"}, body: JSON.stringify({ amount: finalPrice, description: currentDesc, phone, email }) });
    const data = await res.json();
    if (data.redirect_url) { window.location.href = data.redirect_url; } else { throw new Error(data.error || "حدث خطأ"); }
  } catch (e) { showError(e.message); document.getElementById("payBtn").disabled = false; }
};
function showError(msg) {
  const el = document.getElementById("status");
  el.className = "status-msg visible error-msg"; el.innerText = msg;
}
function showLoading() {
  const el = document.getElementById("status");
  el.className = "status-msg visible loading-msg"; el.innerText = "جاري الاتصال بالبوابة الآمنة...";
}
</script>
</body>
</html>
