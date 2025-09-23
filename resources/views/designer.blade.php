@extends('layouts.app')

@section('content')

<section class="max-w-5xl mx-auto mb-6 px-4">
  <div class="bg-white/60 backdrop-blur-sm rounded-xl px-6 py-4 shadow-md text-center">
    <h2 class="text-2xl font-semibold text-gray-800">Visualiza tu espacio verde ideal</h2>
    <p class="text-gray-700 mt-2">
      Sube una foto de tu jardín, terraza o rincón favorito. Nuestro diseñador AI te ayudará a transformarlo.
    </p>
  </div>
</section>
<main id="designer" class="bg-white/30 backdrop-blur-sm p-6 md:p-8 rounded-2xl card-shadow max-w-5xl mx-auto">

    <!-- Error Alert Banner -->
    <div id="error-banner" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
        <strong class="font-bold">¡Error!</strong>
        <span class="block sm:inline" id="error-message"></span>
        <span id="close-error-banner" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div id="upload-section">
            <h2 class="text-2xl font-semibold mb-4 text-gray-100">1. Sube una foto de tu espacio</h2>
            <div id="image-drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-emerald-500 hover:bg-emerald-50 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="mt-2 text-gray-500">Arrastra y suelta una imagen aquí, o haz clic para seleccionar</p>
                <input type="file" id="image-upload" class="hidden" accept="image/*">
                <p id="file-name" class="text-sm text-emerald-600 mt-2 font-medium"></p>
            </div>
            <div id="image-preview-container" class="mt-4 hidden">
                <p class="font-medium mb-2 text-gray-600">Tu Espacio Actual:</p>
                <img id="image-preview" src="#" alt="Vista previa de la imagen" class="rounded-lg max-h-64 w-auto mx-auto shadow-md"/>
            </div>
        </div>

        <div id="style-section" class="hidden">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">2. Elige un estilo de diseño</h2>
            <p class="text-gray-500 mb-4">Selecciona la transformación que sueñas para tu área verde.</p>
            <select id="design-style" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                <option value="Jardín Minimalista Moderno con suculentas y piedras decorativas">Jardín Minimalista Moderno</option>
                <option value="Oasis Tropical Exuberante con palmeras y flores vibrantes">Oasis Tropical Exuberante</option>
                <option value="Jardín Rústico Campestre con flores silvestres y madera">Jardín Rústico Campestre</option>
                <option value="Balcón Urbano Acogedor con macetas colgantes y enredaderas">Balcón Urbano Acogedor</option>
                <option value="Patio Interior Zen con bambú, agua y rocas">Patio Interior Zen</option>
                <option value="Terraza Mediterránea con lavanda, olivos y terracota">Terraza Mediterránea</option>
            </select>
            <button id="generate-button" class="mt-6 w-full bg-emerald-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-transform duration-200 transform hover:scale-105 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:scale-100" disabled>
                Generar Diseño y Video
            </button>
        </div>
    </div>

    <div id="result-section" class="mt-12 text-center hidden">
         <div id="loader" class="mx-auto mb-4 hidden">
            <div class="loader"></div>
            <p class="text-gray-600 mt-2">Nuestra IA está diseñando tu espacio... Esto puede tardar un momento.</p>
        </div>
        <div id="result-content" class="hidden">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">¡Tu nuevo espacio está listo!</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="text-xl font-semibold mb-3 text-emerald-600">Diseño Sugerido por IA</h3>
                    <img id="generated-image-result" src="#" alt="Imagen Generada por IA" class="rounded-xl shadow-lg w-full h-auto object-cover">
                     <div class="mt-6 flex flex-col sm:flex-row justify-center items-center gap-4">
                        <a id="download-button" href="#" download="diseno_verde_ai.png" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gray-700 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-800 transition-transform duration-200 transform hover:scale-105">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            Descargar Foto
                        </a>
                        <button id="request-service-button" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-emerald-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-emerald-600 transition-transform duration-200 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" /></svg>
                            ¡Lo quiero! Cotizar
                        </button>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                   <h3 class="text-xl font-semibold mb-3 text-gray-700">Video de la Transformación</h3>
                   <div id="video-player" class="video-container card-shadow">
                       <img id="before-video-img" src="#" alt="Imagen Original" class="before-video">
                       <img id="after-video-img" src="#" alt="Imagen Generada" class="after-video">
                   </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full relative card-shadow">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="text-2xl font-bold mb-4 text-gray-800">Solicita tu cotización</h3>
            <p class="text-gray-600 mb-6">Uno de nuestros expertos se pondrá en contacto contigo a la brevedad.</p>
            <form id="contact-form">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" id="name" name="name" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje (opcional)</label>
                    <textarea id="message" name="message" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500" placeholder="Cuéntanos más sobre tu proyecto..."></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-500 text-white font-bold py-3 rounded-lg hover:bg-emerald-600 transition">Enviar Solicitud</button>
            </form>
             <div id="form-success-message" class="hidden mt-4 text-center p-4 bg-emerald-100 text-emerald-800 rounded-lg">
                ¡Gracias! Hemos recibido tu solicitud. Pronto nos pondremos en contacto contigo.
            </div>
        </div>
    </div>

</main>

<section id="catalog" class="max-w-5xl mx-auto mt-12 md:mt-20 px-4">
    <div class="text-center mb-12">
  <div class="inline-block bg-white/50 backdrop-blur-md rounded-xl px-6 py-4 shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">
      Explora Nuestro Catálogo de Plantas
    </h2>
    <p class="text-gray-700 max-w-2xl mx-auto">
      Una selección de nuestras plantas favoritas para transformar cualquier espacio, interior o exterior.
    </p>
  </div>
</div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white rounded-xl overflow-hidden card-shadow transform hover:-translate-y-2 transition-transform duration-300">
            <img src="https://placehold.co/400x300/A7F3D0/15803D?text=Monstera" alt="Monstera Deliciosa" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-800">Monstera Deliciosa</h3>
                <p class="text-gray-600 text-sm mt-1">Ideal para interiores luminosos, fácil de cuidar.</p>
                <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-semibold mt-4 px-2.5 py-0.5 rounded-full">Interior</span>
            </div>
        </div>
        <div class="bg-white rounded-xl overflow-hidden card-shadow transform hover:-translate-y-2 transition-transform duration-300">
            <img src="https://placehold.co/400x300/FBCFE8/9D174D?text=Lavanda" alt="Lavanda" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-800">Lavanda</h3>
                <p class="text-gray-600 text-sm mt-1">Aromática y resistente, perfecta para exteriores soleados.</p>
                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold mt-4 px-2.5 py-0.5 rounded-full">Pleno Sol</span>
            </div>
        </div>
        <div class="bg-white rounded-xl overflow-hidden card-shadow transform hover:-translate-y-2 transition-transform duration-300">
            <img src="https://placehold.co/400x300/BFDBFE/1E40AF?text=Helecho" alt="Helecho de Boston" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-800">Helecho de Boston</h3>
                <p class="text-gray-600 text-sm mt-1">Aporta frondosidad y purifica el aire en zonas de sombra.</p>
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mt-4 px-2.5 py-0.5 rounded-full">Sombra Parcial</span>
            </div>
        </div>
        <div class="bg-white rounded-xl overflow-hidden card-shadow transform hover:-translate-y-2 transition-transform duration-300">
            <img src="https://placehold.co/400x300/DDD6FE/5B21B6?text=Suculenta" alt="Suculenta Echeveria" class="w-full h-48 object-cover">
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-800">Suculenta Echeveria</h3>
                <p class="text-gray-600 text-sm mt-1">Bajo mantenimiento y gran belleza, ideal para macetas.</p>
                <span class="inline-block bg-purple-100 text-purple-800 text-xs font-semibold mt-4 px-2.5 py-0.5 rounded-full">Bajo Riego</span>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="max-w-5xl mx-auto mt-12 md:mt-20 text-center px-4">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Ponte en Contacto con Nosotros</h2>
    <p class="text-gray-600 mb-8 max-w-2xl mx-auto">¿Listo para empezar tu proyecto o tienes alguna pregunta? Estamos aquí para ayudarte a crear el jardín de tus sueños.</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800">Llámanos</h3>
            <p class="text-emerald-600 font-medium mt-2 hover:underline"><a href="tel:+51987654321">+51 919 630 903</a></p>
        </div>
        <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800">Escríbenos</h3>
            <p class="text-emerald-600 font-medium mt-2 hover:underline"><a href="mailto:hola@verdeai.com">alejandrolr1508999@gmail.com</a></p>
        </div>
        <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl card-shadow">
            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 mx-auto mb-4">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800">Síguenos</h3>
            <p class="text-emerald-600 font-medium mt-2 hover:underline"><a href="#">@Arborea</a></p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<style>
    .card-shadow {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #10B981;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .video-container {
        position: relative;
        width: 100%;
        padding-top: 75%; 
        overflow: hidden;
        border-radius: 0.75rem;
    }
    .video-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 1s ease-in-out;
    }
    .video-container .before-video {
        z-index: 10;
        opacity: 1;
    }
    .video-container.playing .before-video {
        animation: crossfade 6s infinite ease-in-out;
    }

    @keyframes crossfade {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
</style>
<script>
    // DOM Elements
    const imageUpload = document.getElementById('image-upload');
    const imageDropArea = document.getElementById('image-drop-area');
    const fileNameDisplay = document.getElementById('file-name');
    const imagePreviewContainer = document.getElementById('image-preview-container');
    const imagePreview = document.getElementById('image-preview');
    const styleSection = document.getElementById('style-section');
    const generateButton = document.getElementById('generate-button');
    const designStyle = document.getElementById('design-style');
    const resultSection = document.getElementById('result-section');
    const resultContent = document.getElementById('result-content');
    const loader = document.getElementById('loader');
    const generatedImageResult = document.getElementById('generated-image-result');
    const downloadButton = document.getElementById('download-button');
    const requestServiceButton = document.getElementById('request-service-button');
    const modal = document.getElementById('modal');
    const closeModal = document.getElementById('close-modal');
    const contactForm = document.getElementById('contact-form');
    const formSuccessMessage = document.getElementById('form-success-message');
    const videoPlayer = document.getElementById('video-player');
    const beforeVideoImg = document.getElementById('before-video-img');
    const afterVideoImg = document.getElementById('after-video-img');
    const errorBanner = document.getElementById('error-banner');
    const errorMessage = document.getElementById('error-message');
    const closeErrorBanner = document.getElementById('close-error-banner');

    let uploadedFile = null;
    let originalImageSrc = null;

    // --- Image Upload Logic ---
    const handleFile = (file) => {
        if (file && file.type.startsWith('image/')) {
            uploadedFile = file;
            fileNameDisplay.textContent = file.name;
            const reader = new FileReader();
            reader.onload = (e) => {
                originalImageSrc = e.target.result;
                imagePreview.src = originalImageSrc;
                imagePreviewContainer.classList.remove('hidden');
                styleSection.classList.remove('hidden');
                generateButton.disabled = false;
            };
            reader.readAsDataURL(file);
        } else {
            alert("Por favor, selecciona un archivo de imagen válido.");
        }
    };

    imageDropArea.addEventListener('click', () => imageUpload.click());
    imageUpload.addEventListener('change', (e) => handleFile(e.target.files[0]));

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        imageDropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    imageDropArea.addEventListener('dragenter', () => imageDropArea.classList.add('bg-emerald-100', 'border-emerald-600'));
    imageDropArea.addEventListener('dragleave', () => imageDropArea.classList.remove('bg-emerald-100', 'border-emerald-600'));
    imageDropArea.addEventListener('drop', (e) => {
        imageDropArea.classList.remove('bg-emerald-100', 'border-emerald-600');
        const dt = e.dataTransfer;
        const file = dt.files[0];
        handleFile(file);
    });

    // --- Error Banner Logic ---
    closeErrorBanner.addEventListener('click', () => {
        errorBanner.classList.add('hidden');
    });

    // --- AI Design Generation ---
    generateButton.addEventListener('click', async () => {
        if (!uploadedFile) {
            alert("Por favor, sube una imagen primero.");
            return;
        }
        
        errorBanner.classList.add('hidden'); // Ocultar errores previos
        resultSection.classList.remove('hidden');
        resultContent.classList.add('hidden');
        loader.classList.remove('hidden');
        videoPlayer.classList.remove('playing');
        generateButton.disabled = true;
        generateButton.textContent = 'Generando...';

        const formData = new FormData();
        formData.append('image', uploadedFile);
        formData.append('style', designStyle.value);

        try {
            const generatedImageBase64 = await callGenerativeAPI(formData);
            const generatedImageSrc = `data:image/png;base64,${generatedImageBase64}`;

            generatedImageResult.src = generatedImageSrc;
            downloadButton.href = generatedImageSrc;
            beforeVideoImg.src = originalImageSrc;
            afterVideoImg.src = generatedImageSrc;

            loader.classList.add('hidden');
            resultContent.classList.remove('hidden');

            setTimeout(() => {
                videoPlayer.classList.add('playing');
            }, 100);

        } catch (error) {
            console.error('Error generating design:', error);
            errorMessage.textContent = error.message || 'Hubo un error al generar el diseño. Por favor, inténtalo de nuevo.';
            errorBanner.classList.remove('hidden');
            loader.classList.add('hidden');
        } finally {
            generateButton.disabled = true;
            let countdown = 60; 
            generateButton.textContent = `Espera ${countdown}s...`;

            const interval = setInterval(() => {
                countdown--;
                if (countdown > 0) {
                    generateButton.textContent = `Espera ${countdown}s...`;
                } else {
                    clearInterval(interval);
                    generateButton.disabled = false;
                    generateButton.textContent = 'Generar Diseño y Video';
                }
            }, 1000);
        }
    });

    async function callGenerativeAPI(formData) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/generate-design', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData,
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.error || 'Error en la respuesta del servidor.');
        }

        if (!result.imageBase64) {
             throw new Error('La respuesta de la IA no contenía una imagen. Inténtalo de nuevo.');
        }

        return result.imageBase64;
    }

    // --- Modal Logic ---
    requestServiceButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        setTimeout(() => {
            formSuccessMessage.classList.add('hidden');
            contactForm.style.display = 'block';
            contactForm.reset();
            const submitButton = contactForm.querySelector('button[type="submit"]');
            submitButton.disabled = false;
            submitButton.textContent = 'Enviar Solicitud';
        }, 300);
    });

    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const submitButton = contactForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Enviando...';
        errorBanner.classList.add('hidden');

        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData.entries());

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/request-quote', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();
            if (!response.ok) {
                throw new Error(result.error || 'Hubo un problema al enviar tu solicitud.');
            }

            contactForm.style.display = 'none';
            formSuccessMessage.classList.remove('hidden');

            setTimeout(() => {
                closeModal.click();
            }, 3000);

        } catch (error) {
            console.error('Form submission error:', error);
            // We can reuse the main error banner or create a specific one for the modal
            alert(error.message); // For simplicity, an alert inside the modal context is fine
            submitButton.disabled = false;
            submitButton.textContent = 'Enviar Solicitud';
        }
    });

</script>
@endpush
