// Sidebar toggle
    document.getElementById("toggle-btn").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("collapsed");
    });
    // Modal functionality
    var authModal = document.getElementById("authModal");
    var openModalBtn = document.getElementById("openModalBtn");
    var closeModalBtn = document.querySelector(".btn-close");
    openModalBtn.onclick = function() {
      authModal.classList.remove("hidden");
    }
    closeModalBtn.onclick = function() {
      authModal.classList.add("hidden");
    }
    window.onclick = function(event) {
      if (event.target == authModal) {
        authModal.classList.add("hidden");
      }
    }
    // Invoice form handler
    document.getElementById("invoiceForm").addEventListener("submit", function(e){
      e.preventDefault();
      alert("Invoice Created for " + document.getElementById("clientName").value + " - $" + document.getElementById("amount").value);
      bootstrap.Modal.getInstance(document.getElementById("invoiceModal")).hide();
    });