document.getElementById('Nutripolls_partners').onclick = function() {
    var partner = document.querySelector('.partner');
    if (partner.classList.contains('show')) {
      partner.classList.remove('show');
      setTimeout(() => { // Wait for the transition to finish before hiding
        partner.style.visibility = 'hidden';
      }, 500); // This should match the transition time
    } else {
      partner.style.visibility = 'visible';
      partner.classList.add('show');
    }
  };