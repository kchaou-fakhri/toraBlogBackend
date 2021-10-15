<template>
  <div id="wrapper">
    <!-- Sidebar -->
    <sidbr v-if="isLogIn == true" />
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
     
      <div id="content">
        
        <navbar  v-if="isLogIn == true"/>
          <div class="container-fluid">
              <router-view  :isLogIn="isLogIn"></router-view>
          </div>
      </div>
      <foooter />
    </div>
  </div>
</template>

<script>
import navbar from "../Layout/Navbar.vue";
import foooter from "../Layout/Footer.vue";
import sidbr from "../Layout/Sidbar.vue";

export default {
  data(){

    return{
      user : '',
      isLogIn : false
    }
  },
  components: {
    navbar,
    foooter,
    sidbr,
  },
  

  mounted() {
     const axios = require('axios');
       axios.get('/api/user').then((result) => {
         this.isLogIn = true;
        
       }).catch((err) => {
         
       });

    (function ($) {
      "use strict"; // Start of use strict

      // Toggle the side navigation
      $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
          $(".sidebar .collapse").collapse("hide");
        }
      });

      // Close any open menu accordions when window is resized below 768px
      $(window).resize(function () {
        if ($(window).width() < 768) {
          $(".sidebar .collapse").collapse("hide");
        }

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
          $("body").addClass("sidebar-toggled");
          $(".sidebar").addClass("toggled");
          $(".sidebar .collapse").collapse("hide");
        }
      });

      // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
      $("body.fixed-nav .sidebar").on(
        "mousewheel DOMMouseScroll wheel",
        function (e) {
          if ($(window).width() > 768) {
            var e0 = e.originalEvent,
              delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
          }
        }
      );

      // Scroll to top button appear
      $(document).on("scroll", function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
          $(".scroll-to-top").fadeIn();
        } else {
          $(".scroll-to-top").fadeOut();
        }
      });

      // Smooth scrolling using jQuery easing
      $(document).on("click", "a.scroll-to-top", function (e) {
        var $anchor = $(this);
        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: $($anchor.attr("href")).offset().top,
            },
            1000,
            "easeInOutExpo"
          );
        e.preventDefault();
      });
    })(jQuery); // End of use strict
  },
};
</script>