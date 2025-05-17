
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
      toggle.addEventListener('click', function (e) {
        e.preventDefault();

        const parent = this.parentElement;
        parent.classList.toggle('open');

        // Fermer les autres
        document.querySelectorAll('.dropdown').forEach(function (item) {
          if (item !== parent) {
            item.classList.remove('open');
          }
        });
      });
    });

    // Fermer si clic en dehors
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown').forEach(function (item) {
          item.classList.remove('open');
        });
      }
    });
  });

