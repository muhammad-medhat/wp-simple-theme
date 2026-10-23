<?php
// Search Form 
 
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
?>
<div class="menu-search" id="menu-search" role="search">
    <div class="menu-search__wrapper">

        <span class="menu-search__icon" aria-hidden="true">🔍</span>

        <input type="search" id="menu-search-input" class="menu-search__input" placeholder="Search menu..."
            autocomplete="off" aria-label="Search menu">

        <button type="button" id="menu-search-clear" class="menu-search__clear" aria-label="Clear search"
            hidden>×</button>

    </div>

    <p id="menu-search-empty" class="menu-search__empty" hidden>
        No menu items found.
    </p>
</div>