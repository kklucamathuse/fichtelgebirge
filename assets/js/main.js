"use strict";

/* General + Third-Party */
import jQuery from "jquery";
import { lazyload } from "./globals/lazyload";
import Alpine from "alpinejs";
import Swiper from "swiper";

// Access imported functions
window.Alpine = Alpine;
window.Swiper = Swiper;

/* Layout-Parts */
import { navigationSubNav } from "./layout/navigation";

/* Blocks */
// import { my-function } from '../../blocks/BLOCKNAME/script';

jQuery(document).ready((_) => {
  // General + Third-Party
  Alpine.start();
  lazyload();

  //Layout-Parts
  navigationSubNav();

  //Blocks
});
