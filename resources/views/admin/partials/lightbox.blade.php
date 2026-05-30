@push('css')
<style>
    /* Lightbox Zoom Gambar */
    .image-lightbox-overlay {
        display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.92); z-index: 10000; justify-content: center; align-items: center; padding: 20px;
    }
    .image-lightbox-overlay.active { display: flex; }
    .image-lightbox-overlay img { max-height: 90vh; max-width: 100%; object-fit: contain; border-radius: 12px; }
    .image-lightbox-close {
        position: absolute; top: 20px; right: 30px; color: white; font-size: 2.5rem; background: none; border: none; cursor: pointer;
    }
    
    /* Efek gambar yang bisa di-zoom */
    .bukti-thumbnail {
        cursor: zoom-in;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .bukti-thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3) !important;
    }
</style>
@endpush

{{-- LIGHTBOX ZOOM GAMBAR --}}
<div id="imageLightbox" class="image-lightbox-overlay">
    <button type="button" class="image-lightbox-close" onclick="closeImageLightbox()">&times;</button>
    <img src="" id="lightboxImage" alt="Zoom">
</div>

@push('scripts')
<script>
    function openImageLightbox(src) {
        document.getElementById('lightboxImage').src = src;
        document.getElementById('imageLightbox').classList.add('active');
    }
    function closeImageLightbox() {
        document.getElementById('imageLightbox').classList.remove('active');
    }
    document.querySelectorAll('.bukti-thumbnail').forEach(img => {
        img.addEventListener('click', function(e) {
            e.stopPropagation(); openImageLightbox(this.src);
        });
    });
    document.getElementById('imageLightbox').addEventListener('click', function(e) {
        if (e.target === this) closeImageLightbox();
    });
</script>
@endpush
