@extends('teacher.master')

@section('content')
<style>
    #editor{

width:100%;
height:520px;

background:#202124;

border-radius:25px;

overflow:hidden;

position:relative;

display:flex;

justify-content:center;

align-items:center;

}

#image{
    position:absolute;
    max-width:none;
    max-height:none;
    cursor:grab;
    user-select:none;
    touch-action:none;
    display:block;
    position:absolute;
    transform-origin:center center;

    left:50%;
    top:50%;

    transform:translate(-50%,-50%);
    transition:
        transform .08s linear;

}

#image:active{

cursor:grabbing;

}

#cropCircle{

width:260px;

height:260px;

border:4px solid white;

border-radius:50%;

box-shadow:0 0 0 9999px rgba(0,0,0,.55);

pointer-events:none;

position:absolute;

}

#preview{

    width:220px;
    height:220px;

    border-radius:50%;

    border:5px solid #fff;

    background:#fff;

    box-shadow:
        0 15px 35px rgba(0,0,0,.18);

}
</style>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-body">

            <h3 class="mb-4">
                Edit Foto Profil
            </h3>

            <input
                type="file"
                id="inputImage"
                accept="image/*"
                class="form-control mb-4">

            <div id="editor">

                <img id="image">

                <div id="cropCircle"></div>

            </div>

            <div class="mt-4">

                <label class="form-label">
                    Zoom
                </label>

                <input
                    type="range"
                    min="1"
                    max="4"
                    value="1"
                    step="0.01"
                    id="zoom"
                    class="form-range">

            </div>

            <div class="text-center mt-4">

                <canvas id="preview"></canvas>

            </div>

            <div class="text-center mt-4">

                <button
                    class="btn btn-primary"
                    id="save">

                    Simpan Foto

                </button>
                <a href="{{ route('teacher.dashboard.index') }}" class="btn btn-warning" type="button">
                    <i class="ti ti-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>

        </div>

    </div>

</div>

@endsection


@push('script')
<script>
    const input = document.getElementById("inputImage");
const image = document.getElementById("image");
const editor = document.getElementById("editor");
const zoom = document.getElementById("zoom");
const circle = document.getElementById("cropCircle");
const preview = document.getElementById("preview");
const pctx = preview.getContext("2d");
const save = document.getElementById("save");

console.log(save);

// =========================
// STATE
// =========================

let isDragging = false;

let startX = 0;
let startY = 0;

let currentX = 0;
let currentY = 0;

let scale = 1;
let minScale = 1;
let maxScale = 5;
preview.width = 250;
preview.height = 250;

// =========================
// RENDER
// =========================

function render() {

    image.style.left = `calc(50% + ${currentX}px)`;
    image.style.top = `calc(50% + ${currentY}px)`;
    image.style.transform =
        `translate(-50%,-50%) scale(${scale})`;

    drawPreview();

}
function drawPreview() {

if (!image.src) return;

pctx.clearRect(0, 0, preview.width, preview.height);

const radius = circle.offsetWidth / 2;

// posisi crop pada gambar asli
const sx = (image.naturalWidth / 2)
    - (radius / scale)
    - (currentX / scale);

const sy = (image.naturalHeight / 2)
    - (radius / scale)
    - (currentY / scale);

const sw = (radius * 2) / scale;
const sh = (radius * 2) / scale;

pctx.save();

pctx.beginPath();
pctx.arc(
    preview.width / 2,
    preview.height / 2,
    preview.width / 2,
    0,
    Math.PI * 2
);
pctx.clip();

pctx.drawImage(
    image,
    sx,
    sy,
    sw,
    sh,
    0,
    0,
    preview.width,
    preview.height
);

pctx.restore();

}

function getCroppedImage(size = 1500) {

const canvas = document.createElement("canvas");
const ctx = canvas.getContext("2d");

canvas.width = size;
canvas.height = size;

const radius = circle.offsetWidth / 2;

const sx =
    (image.naturalWidth / 2)
    - (radius / scale)
    - (currentX / scale);

const sy =
    (image.naturalHeight / 2)
    - (radius / scale)
    - (currentY / scale);

const sw = (radius * 2) / scale;
const sh = (radius * 2) / scale;

ctx.save();

ctx.beginPath();
ctx.arc(
    size / 2,
    size / 2,
    size / 2,
    0,
    Math.PI * 2
);
ctx.clip();

ctx.drawImage(
    image,
    sx,
    sy,
    sw,
    sh,
    0,
    0,
    size,
    size
);

ctx.restore();

return canvas;

}

// =========================
// BOUNDARY
// =========================

function constrain() {

    const radius = circle.offsetWidth / 2;

    const width = image.naturalWidth * scale;
    const height = image.naturalHeight * scale;

    const limitX = Math.max(0, width / 2 - radius);
    const limitY = Math.max(0, height / 2 - radius);

    currentX = Math.max(-limitX, Math.min(limitX, currentX));
    currentY = Math.max(-limitY, Math.min(limitY, currentY));

}

// =========================
// LOAD IMAGE
// =========================

input.addEventListener("change", function (e) {

    const file = e.target.files[0];

    if (!file) return;

    image.onload = function () {

        // ukuran asli gambar
        image.style.width = image.naturalWidth + "px";
        image.style.height = image.naturalHeight + "px";

        const need = circle.offsetWidth;

        const sx = need / image.naturalWidth;
        const sy = need / image.naturalHeight;

        minScale = Math.max(sx, sy);

        scale = minScale;

        maxScale = minScale * 3;

        zoom.min = minScale;
        zoom.max = maxScale;
        zoom.value = scale;
        zoom.step = 0.01;

        currentX = 0;
        currentY = 0;

        constrain();
        render();

    }

    image.src = URL.createObjectURL(file);

});

// =========================
// DRAG DESKTOP
// =========================

image.addEventListener("mousedown", function (e) {

    isDragging = true;

    image.style.transition = "none";

    startX = e.clientX - currentX;
    startY = e.clientY - currentY;

});

document.addEventListener("mousemove", function (e) {

    if (!isDragging) return;

    currentX = e.clientX - startX;
    currentY = e.clientY - startY;

    constrain();
    render();

});

document.addEventListener("mouseup", function () {

    isDragging = false;

});

// =========================
// TOUCH
// =========================

image.addEventListener("touchstart", function (e) {

    isDragging = true;

    const touch = e.touches[0];

    startX = touch.clientX - currentX;
    startY = touch.clientY - currentY;

});

document.addEventListener("touchmove", function (e) {

    if (!isDragging) return;

    const touch = e.touches[0];

    currentX = touch.clientX - startX;
    currentY = touch.clientY - startY;

    constrain();
    render();

});

document.addEventListener("touchend", function () {

    isDragging = false;

});

// =========================
// SLIDER
// =========================

zoom.addEventListener("input", function () {

    scale = Number(this.value);

    constrain();
    render();

});

// =========================
// MOUSE WHEEL
// =========================

editor.addEventListener("wheel", function (e) {

    e.preventDefault();

    scale -= e.deltaY * 0.0015;

    scale = Math.max(minScale, Math.min(scale, maxScale));

    zoom.value = scale;

    constrain();
    render();

}, {
    passive: false
});

</script>

<script>
    save.addEventListener("click", function () {
    const canvas = getCroppedImage(1500);
    const image = canvas.toDataURL("image/png");
    fetch("/teacher/profile/photo", {
        method: "POST",
        headers: {
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":document
                .querySelector('meta[name="csrf-token"]')
                .content
        },
        body: JSON.stringify({
            image:image
        })
    })
    .then(r=>r.json())
    .then(res=>{
        if(res.success){
            const navbarAvatar = document.getElementById("navbarAvatar");
            const dropdownAvatar = document.getElementById("dropdownAvatar");

            if (navbarAvatar) {
                navbarAvatar.src = res.image + "?" + Date.now();
            }
              if (dropdownAvatar) {
            dropdownAvatar.src = res.image + "?" + Date.now();
        }
            alert("Foto berhasil diperbarui 🎉");
        }
    });
});
</script>


@endpush