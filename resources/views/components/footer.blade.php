<footer class="footer-govco">
    <div class="footer-top">
        <div class="footer-column footer-column-logos">
            <img src="/logos/logo_govco.png" alt="GOV.CO" class="footer-logo">
            <img src="/logos/logo_vida.png" alt="Colombia Potencia de la Vida" class="footer-logo">
            <img src="/logos/logo_co.svg" alt="CO Colombia" class="footer-logo">
        </div>

        <div class="footer-column">
            <h4>{{ __('footer.portal') }}</h4>
            <p>{{ __('footer.address') }}</p>
            <p><strong>{{ __('footer.attentionHours') }}</strong></p>
            <p>{{ __('footer.presentialAttention') }}</p>
            <p>{{ __('footer.virtualAttention') }}</p>
            <p><strong>{{ __('footer.postalCode') }}</strong> 860001</p>
        </div>

        <div class="footer-column">
            <h4>{{ __('footer.contact') }}</h4>
            <p><strong>{{ __('footer.phone') }}</strong></p>
            <p>{{ __('footer.nationalPhone') }}</p>
            <p>{{ __('footer.mocoaPhone') }}</p>
            <p>{{ __('footer.antiCorruptionLine') }}</p>
            <p><strong>{{ __('footer.institutionalEmail') }}</strong></p>
            <p>contactenos@putumayo.gov.co</p>
            <p>notificaciones.judiciales@putumayo.gov.co</p>
            <a href="/contact">{{ __('footer.requestCall') }}</a> | <a href="/web-call">{{ __('footer.webCall') }}</a> | <a href="/chat">{{ __('footer.chat') }}</a>
        </div>

        <div class="footer-column">
            <h4>{{ __('footer.about') }}</h4>
            <a href="/sitemap">{{ __('footer.sitemap') }}</a>
            <a href="/privacy">{{ __('footer.privacyPolicy') }}</a>
            <a href="/copyright">{{ __('footer.copyrightPolicy') }}</a>
            <a href="/terms">{{ __('footer.termsAndConditions') }}</a>
            <a href="/accessibility">{{ __('footer.accessibilityHelp') }}</a>
            <div class="social-icons">
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">{{ __('footer.followTwitter') }}</a>
                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer">{{ __('footer.followFacebook') }}</a>
                <a href="https://youtube.com" target="_blank" rel="noopener noreferrer">{{ __('footer.followYoutube') }}</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p id="local-time"></p>
        <p>{{ __('footer.unitTechnology') }} @2024</p>
    </div>
</footer>

<script>
    function updateTime() {
        const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', timeZone: 'America/Bogota' };
        const timeNow = new Intl.DateTimeFormat('es-CO', options).format(new Date());
        document.getElementById('local-time').textContent = timeNow + ' {{ __("footer.legalTime") }}';
    }

    setInterval(updateTime, 1000);
    updateTime(); // Initial call to set time immediately on load
</script>

<style scoped>
.footer-govco {
background-color: var(--govco-secondary-color);
color: var(--govco-white-color);
padding: 30px 0;
font-family: var(--govco-font-family);
}

.footer-top {
display: flex;
justify-content: space-around;
align-items: flex-start;
margin-bottom: 20px;
padding: 0 30px;
}

/* Estilos para las columnas del footer */
.footer-column {
flex: 1;
max-width: 300px;
margin-bottom: 20px; /* Agregar separación entre columnas */
}

.footer-column h4 {
font-size: 18px;
margin-bottom: 15px;
color: var(--govco-white-color);
}

.footer-column p,
.footer-column a {
color: var(--govco-white-color);
font-size: 14px;
margin-bottom: 5px;
}

.footer-column a {
text-decoration: none;
color: var(--govco-white-color);
}

.footer-column a:hover {
color: var(--govco-highlight-color); /* Naranja de resalto */
}

/* Estilos para la columna de los logos */
.footer-column-logos {
display: flex;
flex-direction: column;
align-items: center;
}

/* Estilo para los logos, asegurando que tengan el mismo tamaño */
.footer-logo {
width: 120px; /* Tamaño uniforme para todos los logos */
height: auto; /* Mantener la proporción del logo */
margin-bottom: 15px; /* Espaciado entre los logos */
}


.social-icons a {
display: block;
margin-bottom: 5px;
}

.footer-bottom {
text-align: center;
padding-top: 10px;
border-top: 1px solid var(--govco-white-color);
}

.footer-bottom p {
font-size: 12px;
color: var(--govco-white-color);
}

/* Media Queries para el footer en pantallas pequeñas */
@media (max-width: 768px) {
    .footer-top {
      flex-direction: column; /* Cambiar a disposición vertical */
      padding: 0 15px; /* Reducir el padding lateral */
    }
  
    .footer-column {
      max-width: 100%; /* Asegurar que las columnas ocupen el 100% del ancho */
      margin-bottom: 20px; /* Mantener el espaciado entre columnas */
      text-align: center; /* Centrar el contenido en columnas */
    }
  
    .footer-column-logos {
      flex-direction: row; /* Cambiar los logos a disposición horizontal */
      justify-content: center; /* Centrar los logos */
    }
  
    .footer-logo {
      width: 80px; /* Reducir el tamaño de los logos en pantallas pequeñas */
      margin-right: 10px; /* Añadir espacio entre los logos en horizontal */
    }
  
    .social-icons {
      display: flex;
      justify-content: center; /* Centrar los iconos de redes sociales */
      flex-wrap: wrap; /* Alinear correctamente si hay más de un ícono */
    }
  
    .social-icons a {
      margin: 0 10px; /* Espacio horizontal entre los enlaces */
    }
  
    .footer-bottom {
      font-size: 12px; /* Reducir ligeramente el tamaño del texto */
      padding: 10px 15px; /* Ajustar el padding */
    }
  
    .footer-bottom p {
      margin-bottom: 10px; /* Añadir espacio inferior */
    }
}

/* Estilos para el modo de alto contraste */
body.high-contrast .footer-govco {
    background-color: #000; /* Fondo negro */
    color: #fff;            /* Texto blanco */
}

body.high-contrast .footer-govco a {
    color: #0ff;            /* Enlaces en cian */
}

body.high-contrast .footer-govco a:hover {
    color: #fff;            /* Enlaces en blanco al pasar el cursor */
}

body.high-contrast .footer-column h4 {
    color: #fff;            /* Encabezados en blanco */
}

body.high-contrast .footer-column p {
    color: #fff;            /* Párrafos en blanco */
}

body.high-contrast .footer-logo {
    filter: invert(1);      /* Invertir colores de los logos */
}

body.high-contrast .footer-bottom {
    border-top: 1px solid #fff; /* Borde superior en blanco */
}

body.high-contrast .footer-bottom p {
    color: #fff;            /* Texto en blanco */
}

body.high-contrast .social-icons a {
    color: #0ff;            /* Iconos de redes sociales en cian */
}

body.high-contrast .social-icons a:hover {
    color: #fff;            /* Iconos en blanco al pasar el cursor */
}

body.high-contrast .social-icons a img {
    filter: invert(1);      /* Invertir colores de los iconos si son imágenes */
}

/* Media Queries para el modo de alto contraste en pantallas pequeñas */
@media (max-width: 768px) {
    body.high-contrast .footer-top {
        /* Mantiene los ajustes responsivos */
    }
}
</style>