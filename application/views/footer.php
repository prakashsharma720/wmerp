<footer class="main-footer no-print">
    <strong>Copyright &copy; 2025 <a target="_blank" href="https://muskowl.com"> Musk Owl</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Developer :Prakash </b>
    </div> -->
    <script>
function applyCustomTheme() {
  const primaryColor = document.getElementById('primaryColor').value;
  const navbarColor = document.getElementById('navbarColor').value;
 const secondaryColor = document.getElementById('secondaryColor').value;

  localStorage.setItem('custom_primary_color', primaryColor);
  localStorage.setItem('custom_navbar', navbarColor);
  localStorage.setItem('custom_secondary', secondaryColor);


  updateFullTheme(primaryColor, navbarColor, secondaryColor);
}

function updateFullTheme(primary, navbar,secondary) {
  const oldStyle = document.getElementById('custom-theme-style');
  if (oldStyle) oldStyle.remove();

  const style = document.createElement('style');
  style.id = 'custom-theme-style';
  style.innerHTML = `
    /* Primary UI elements */
    .btn,.card-primary:not(.card-outline) .card-header ,.top-progress-fill,.page-item.active ,.page-link {
      background-color: ${primary} !important;
      border-color: ${secondary} !important;
      color: ${secondary} !important;
    }
    .card-primary.card-outline {
      border-top: 3px solid  ${primary} !important;
    }
    .btn{
      background-color: ${shadeColor(primary, -10)} !important;
    }

    .table thead,
    .table-primary thead,
    thead {
      background-color: ${primary} !important;
      color: ${secondary} !important;
    }

    .accordion .card-header,
    .card.border-top {
      border-top: 3px solid ${primary} !important;
    }

    input:focus, select:focus, textarea:focus,
    input:hover, select:hover, textarea:hover {
      border-color: ${primary} !important;
      box-shadow: 0 0 0 0.1rem ${hexToRgba(primary, 0.25)} !important;
    }

    /* Sidebar Inner auto set with primary */
    .main-sidebar .sidebar {
      background-color: ${primary} !important;
    }

    /* Navbar */
    .main-header, .navbar {
      background-color: ${navbar} !important;
    }

    /* Active sidebar link */
    .nav-pills .nav-link.active{
      background-color: ${primary} !important;
      color: ${secondary} !important;
    }
    .main-sidebar .sidebar .nav-treeview .nav-link.active{
      background-color: ${secondary} !important;
      color: ${primary} !important;
  }
   
   #bread ul li label {
    background-color: ${primary};
    color: ${secondary};
  }
  div[role="progressbar"]{
    --fg: ${primary};
  }

  `;
  document.head.appendChild(style);
}

function shadeColor(color, percent) {
  let R = parseInt(color.substring(1, 3), 16);
  let G = parseInt(color.substring(3, 5), 16);
  let B = parseInt(color.substring(5, 7), 16);
  R = Math.min(255, parseInt(R * (100 + percent) / 100));
  G = Math.min(255, parseInt(G * (100 + percent) / 100));
  B = Math.min(255, parseInt(B * (100 + percent) / 100));
  return `#${R.toString(16).padStart(2, '0')}${G.toString(16).padStart(2, '0')}${B.toString(16).padStart(2, '0')}`;
}

function hexToRgba(hex, alpha = 1) {
  const r = parseInt(hex.slice(1, 3), 16);
  const g = parseInt(hex.slice(3, 5), 16);
  const b = parseInt(hex.slice(5, 7), 16);
  return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

document.addEventListener('DOMContentLoaded', () => {
  const primary = localStorage.getItem('custom_primary_color') || '#007bff';
  const navbar = localStorage.getItem('custom_navbar') || '#007bff';
const secondary = localStorage.getItem('custom_secondary') || '#6c757d';

  document.getElementById('primaryColor').value = primary;
  document.getElementById('navbarColor').value = navbar;
document.getElementById('secondaryColor').value = secondary;


  updateFullTheme(primary, navbar,secondary);
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Prevent dropdown from closing when clicking inside
    document.querySelectorAll('.dropdown-menu').forEach(function (dropdown) {
      dropdown.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    });
  });
</script>

  </footer>