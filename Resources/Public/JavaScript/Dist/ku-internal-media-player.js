/*
 * Script for html5 multiple videos - inserts and toggles play/pause button, nothing else.
 * Markup:
 * <div class="video-container">
 *  <video autoplay="" class="video" loop="" muted="" playsinline="" poster="" preload="metadata">
 *     <source src="file-path.mp4">
 *   </video>
 * </div>
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';
  
    const lang = document.documentElement.lang;
    let translations;
    if (lang === 'da') {
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
  
    const videos = document.querySelectorAll('figure.video');
    if (!videos) {
      return;
    }
    const button = '<button aria-label="' + translations.pause + '" aria-pressed="false" class="play-pause-button" type="button"></button>';
  
    class Video {
      constructor(video) {
        this.videoContainer = video;
        // Append button
        this.videoContainer.insertAdjacentHTML('beforeend', button);
        this.video = this.videoContainer.querySelector('video');
        // Remove controls
        // this.video.removeAttribute('controls'); 
        this.btn = this.videoContainer.querySelector('.play-pause-button');
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
        this.btn.classList.remove('paused');
        this.btn.setAttribute('aria-pressed', 'false');
        this.btn.setAttribute('aria-label', translations.pause);
      }
  
      pauseVideo() {
        this.video.pause();
        this.btn.classList.add('paused');
        this.btn.setAttribute('aria-pressed', 'true');
        this.btn.setAttribute('aria-label', translations.play);
  
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
  