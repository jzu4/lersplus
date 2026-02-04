const WORKER_URL = "https://jzu4.github.io/lersplus/worker.js";

document.getElementById("payform").addEventListener("submit", async (e) => {
  e.preventDefault();

  const status = document.getElementById("status");

  const amount = amountEl.value;
  const desc   = descEl.value;
  const phone  = phoneEl.value;
  const email  = emailEl.value;

  status.innerText = "جاري إنشاء طلب الدفع...";

  try {
    const res = await fetch(`${WORKER_URL}/api/create-payment`, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ amount, description: desc, phone, email })
    });

    const data = await res.json();

    if (data.redirect_url) {
      window.location.href = data.redirect_url;
    } else {
      status.innerText = "فشل إنشاء الطلب";
    }
  } catch {
    status.innerText = "خطأ في الاتصال بالخادم";
  }
});
