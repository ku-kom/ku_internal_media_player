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

    const lang = document.documentElement.lang;
    let translations;
    if (lang === 'da-DK') {
        translations = {
            'pause': 'Stop afspilning (brug Enter tast)',
            'play': 'Afspil (brug Enter tast)'
        }
    } else {
        translations = {
            'pause': 'Pause (use Enter key)',
            'play': 'Play (use Enter bar)'
        }
    }

    const videos = document.querySelectorAll('figure.video.controls-disabled');
    if (!videos) {
        return;
    }
    const play = 'bi-play-fill';
    const pause = 'bi-pause-fill';
    const button = `<button aria-pressed="false" class="video-button" type="button"><span class="visually-hidden">${translations.pause}</span></button>`;

    class Video {
        constructor(video) {
            this.videoContainer = video;
            // Append button
            this.videoContainer.insertAdjacentHTML('beforeend', button);
            this.video = this.videoContainer.querySelector('video');
            this.btn = this.videoContainer.querySelector('.video-button');
            this.btnText = this.btn.querySelector('span');
            let state = this.video.getAttribute('autoplay');
            // Toggle icon according to autoplay state
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
            this.btn.classList.remove(pause);
            this.btn.classList.add(play);
            this.btn.setAttribute('aria-pressed', 'false');
            this.btnText.innerText = translations.pause;
        }

        pauseVideo() {
            this.video.pause();
            this.btn.classList.remove(play);
            this.btn.classList.add(pause);
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
