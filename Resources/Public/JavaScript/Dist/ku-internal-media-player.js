/*
 * Script for html5 multiple videos - inserts and toggles play/pause button, nothing else.
 * Markup:
 * <figure class="video controls-disabled">
 *  <video autoplay="" class="video" loop="" muted="" playsinline="" poster="" preload="metadata">
 *     <source src="file-path.mp4">
 *   </video>
 * </figure>
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const videos = document.querySelectorAll('figure.video.controls-disabled');
    if (!videos) {
        return;
    }
    const play = 'bi-play-fill';
    const pause = 'bi-pause-fill';
    const button = `<button aria-pressed="false" class="video-button bi" type="button"><span class="visually-hidden">${translations.pause}</span></button>`;

    class Video {
        constructor(video) {
            this.videoContainer = video;
            // Append button
            this.videoContainer.insertAdjacentHTML('beforeend', button);
            this.video = this.videoContainer.querySelector('video');
            this.btn = this.videoContainer.querySelector('.video-button');
            this.btnText = this.btn.querySelector('span');
            // remove attribute "controls" since we can't do it in fluid's  <f:media>
            this.video.removeAttribute('controls');
            const state = this.video.hasAttribute('autoplay');
            // Toggle icon according to initial autoplay state
            (state ==! '') ? this.btn.classList.add(pause) : this.btn.classList.add(play);
            this.prefersReducedMotion();
            this.addEventListeners();
        }

        addEventListeners() {
            this.btn.addEventListener('click', () => {
                this.togglePlayPause();
            });
        }

        togglePlayPause() {
            if (this.video.paused || this.video.ended) {
                this.playVideo();
            } else {
                this.pauseVideo();
            }
        }

        playVideo() {
            this.video.play();
            this.btn.classList.replace(play, pause);
            this.btn.setAttribute('aria-pressed', 'false');
            this.btnText.innerText = translations.pause;
        }

        pauseVideo() {
            this.video.pause();
            this.btn.classList.replace(pause, play);
            this.btn.setAttribute('aria-pressed', 'true');
            this.btnText.innerText = translations.play;
        }

        prefersReducedMotion() {
            if (this.video.autoplay === false || matchMedia('(prefers-reduced-motion)').matches) {
                this.video.removeAttribute('autoplay');
                this.pauseVideo();
                this.video.currentTime = 0;
            }
        }
    }

    Array.from(videos).forEach((video) => {
        const videoEl = new Video(video);
    });

});
