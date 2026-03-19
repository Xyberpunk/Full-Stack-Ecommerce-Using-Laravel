(function ($) {

  "use strict";

  $(document).ready(function () {

    $("#preloader").fadeOut("slow");

    if ($.fn && typeof $.fn.hcSticky === 'function' && $('.feat-swiper').length) {
      $('.feat-swiper').hcSticky({
        stickTo: $('.feat-product-grid')
      });
    }

    $(".user-items .search-item").click(function () {
      $(".search-box").toggleClass('active');
      $(".search-box .search-input").focus();
    });
    $(".close-button").click(function () {
      $(".search-box").toggleClass('active');
    });

    if (typeof Swiper !== 'undefined' && $('.main-swiper').length) {
      var swiper = new Swiper(".main-swiper", {
        speed: 500,
        loop: true,
        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        },
        pagination: {
          el: "#billboard .swiper-pagination",
          clickable: true,
        },
      });
    }

    if (typeof Swiper !== 'undefined') {
      $('.product-swiper').each(function () {
        var sectionId = $(this).attr('id');
        if (!sectionId) return;
        if ($("#" + sectionId + " .swiper").length === 0) return;
        var swiper = new Swiper("#" + sectionId + " .swiper", {
          slidesPerView: 4,
          spaceBetween: 20,
          loop: true,
          speed: 600,
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },
          pagination: {
            el: "#" + sectionId + " .swiper-pagination",
            clickable: true,
          },
          breakpoints: {
            0: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 10,
            },
            999: {
              slidesPerView: 3,
              spaceBetween: 10,
            },
            1366: {
              slidesPerView: 4,
              spaceBetween: 40,
            },
          },
        });
      })
    }

    if (typeof Swiper !== 'undefined' && $('.testimonial-swiper').length) {
      var swiper = new Swiper(".testimonial-swiper", {
        loop: true,
        navigation: {
          nextEl: ".swiper-arrow-next",
          prevEl: ".swiper-arrow-prev",
        },
        pagination: {
          el: "#testimonials .swiper-pagination",
          clickable: true,
        },
      });
    }

    if (typeof Swiper !== 'undefined' && $('.collection-swiper').length) {
      var swiper = new Swiper(".collection-swiper", {
        slidesPerView: 4,
        spaceBetween: 10,
        loop: false,
        pagination: {
          el: "#collections .swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          599: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          980: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
        },
      });
    }


    // product single page
    var thumb_slider = null;
    if (typeof Swiper !== 'undefined' && $('.product-thumbnail-slider').length) {
      thumb_slider = new Swiper(".product-thumbnail-slider", {
        slidesPerView: 3,
        spaceBetween: 20,
        autoplay: true,
        direction: "vertical",
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    }

    if (typeof Swiper !== 'undefined' && $('.product-large-slider').length) {
      var large_slider = new Swiper(".product-large-slider", {
        slidesPerView: 1,
        autoplay: true,
        spaceBetween: 0,
        effect: 'fade',
        thumbs: thumb_slider
          ? { swiper: thumb_slider }
          : undefined,
      });
    }

    if (typeof Swiper !== 'undefined' && $('.feat-swiper').length) {
      var swiper3 = new Swiper(".feat-swiper", {
        grabCursor: true,
        effect: "creative",
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        creativeEffect: {
          prev: {
            shadow: true,
            translate: ["-20%", 0, -1],
          },
          next: {
            translate: ["100%", 0, 0],
          },
        },
      });
    }

    // input spinner
    var initQuantitySpinner = function () {
      $(document).on('click', '.product-qty .quantity-right-plus', function (e) {
        e.preventDefault();
        var $qty = $(this).closest('.product-qty');
        var $input = $qty.find('input[name="quantity"]').first();
        if ($input.length === 0) return;
        var quantity = parseInt($input.val(), 10);
        if (!Number.isFinite(quantity) || quantity < 1) quantity = 1;
        $input.val(quantity + 1).trigger('change');
      });

      $(document).on('click', '.product-qty .quantity-left-minus', function (e) {
        e.preventDefault();
        var $qty = $(this).closest('.product-qty');
        var $input = $qty.find('input[name="quantity"]').first();
        if ($input.length === 0) return;
        var quantity = parseInt($input.val(), 10);
        if (!Number.isFinite(quantity) || quantity < 1) quantity = 1;
        if (quantity > 1) {
          $input.val(quantity - 1).trigger('change');
        }
      });

    }
    initQuantitySpinner();

    // cart + checkout (API-backed)
    var CART_TOKEN_KEY_PREFIX = 'rural_cart_token_v2';
    var cartState = {
      cart_token: null,
      items: [],
      subtotal: 0,
      total: 0
    };

    var parseMoney = function (text) {
      if (!text) return 0;
      var normalized = String(text).replace(/[^0-9.\-]/g, '');
      var value = parseFloat(normalized);
      return Number.isFinite(value) ? value : 0;
    };

    var formatMoney = function (value) {
      var number = Number(value);
      if (!Number.isFinite(number)) number = 0;
      return '$' + number.toFixed(2);
    };

    var getAuthUserId = function () {
      var meta = document.querySelector('meta[name="auth-user-id"]');
      if (!meta) return '';
      return String(meta.getAttribute('content') || '').trim();
    };

    var getCartTokenKey = function () {
      var userId = getAuthUserId();
      return userId ? CART_TOKEN_KEY_PREFIX + '_user_' + userId : CART_TOKEN_KEY_PREFIX + '_guest';
    };

    var getGuestCartToken = function () {
      try {
        return localStorage.getItem(CART_TOKEN_KEY_PREFIX + '_guest') || '';
      } catch (err) {
        return '';
      }
    };

    var getStoredCartToken = function () {
      try {
        return localStorage.getItem(getCartTokenKey()) || '';
      } catch (err) {
        return '';
      }
    };

    var storeCartToken = function (token) {
      try {
        if (token) {
          localStorage.setItem(getCartTokenKey(), token);
        }
      } catch (err) { }
    };

    var updateCartState = function (payload) {
      cartState = {
        cart_token: payload && payload.cart_token ? payload.cart_token : getStoredCartToken(),
        items: payload && Array.isArray(payload.items) ? payload.items : [],
        subtotal: payload && Number.isFinite(Number(payload.subtotal)) ? Number(payload.subtotal) : 0,
        total: payload && Number.isFinite(Number(payload.total)) ? Number(payload.total) : 0
      };

      if (cartState.cart_token) {
        storeCartToken(cartState.cart_token);
      }

      return cartState;
    };

    var recalculateCartState = function () {
      var subtotal = cartState.items.reduce(function (sum, item) {
        var price = Number(item.price) || 0;
        var quantity = parseInt(item.quantity, 10) || 0;
        item.line_total = price * quantity;
        return sum + item.line_total;
      }, 0);

      cartState.subtotal = subtotal;
      cartState.total = subtotal;

      return cartState;
    };

    var cartApi = function (url, options) {
      var settings = options || {};
      var headers = settings.headers || {};
      var token = getStoredCartToken();

      if (!token && getAuthUserId()) {
        token = getGuestCartToken();
      }

      headers['Accept'] = headers['Accept'] || 'application/json';

      if (token) {
        headers['X-Cart-Token'] = token;
      }

      if (settings.body && !headers['Content-Type']) {
        headers['Content-Type'] = 'application/json';
      }

      return fetch(url, {
        method: settings.method || 'GET',
        headers: headers,
        body: settings.body ? JSON.stringify(settings.body) : undefined
      }).then(function (response) {
        return response.text().then(function (text) {
          var payload = {};
          try {
            payload = text ? JSON.parse(text) : {};
          } catch (err) {
            payload = {
              message: response.ok ? 'Unexpected server response.' : 'The server returned an HTML error page instead of JSON.'
            };
          }

          if (!response.ok) {
            var message = payload && payload.message ? payload.message : 'Request failed.';
            throw new Error(message);
          }

          return updateCartState(payload);
        });
      });
    };

    var fetchCart = function () {
      return cartApi('/api/cart');
    };

    var addToCart = function (productId, qty) {
      return cartApi('/api/cart/items', {
        method: 'POST',
        body: {
          cart_token: getStoredCartToken(),
          product_id: productId,
          quantity: qty
        }
      });
    };

    var setCartQty = function (productId, qty) {
      return cartApi('/api/cart/items/' + productId, {
        method: 'PATCH',
        body: {
          cart_token: getStoredCartToken(),
          quantity: qty
        }
      });
    };

    var removeCartItem = function (productId) {
      return cartApi('/api/cart/items/' + productId, {
        method: 'DELETE',
        body: {
          cart_token: getStoredCartToken()
        }
      });
    };

    var syncCartState = function () {
      return fetchCart().catch(function () {
        return cartState;
      });
    };

    var checkoutCart = function (payload) {
      var body = payload || {};
      body.cart_token = getStoredCartToken();

      return fetch('/api/checkout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(body)
      }).then(function (response) {
        return response.text().then(function (text) {
          var data = {};
          try {
            data = text ? JSON.parse(text) : {};
          } catch (err) {
            throw new Error('The checkout endpoint returned HTML instead of JSON. Check the Laravel error log or missing migrations.');
          }

          if (!response.ok) {
            throw new Error(data && data.message ? data.message : 'Checkout failed.');
          }

          updateCartState({
            cart_token: getStoredCartToken(),
            items: [],
            subtotal: 0,
            total: 0
          });
          return data;
        });
      });
    };

    var applyCoupon = function (code, shippingMethod) {
      return fetch('/api/coupons/apply', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          cart_token: getStoredCartToken(),
          coupon_code: code,
          shipping_method: shippingMethod || 'standard'
        })
      }).then(function (response) {
        return response.text().then(function (text) {
          var data = {};
          try {
            data = text ? JSON.parse(text) : {};
          } catch (err) {
            throw new Error('Coupon endpoint returned HTML instead of JSON.');
          }

          if (!response.ok) {
            var message = data && data.message ? data.message : 'Coupon could not be applied.';
            if (data && data.errors && data.errors.coupon_code && data.errors.coupon_code.length) {
              message = data.errors.coupon_code[0];
            }
            throw new Error(message);
          }

          return data;
        });
      });
    };

    var showCartToast = function (message) {
      var $existing = $('.cart-toast').first();
      if ($existing.length) $existing.remove();

      var $toast = $('<div class="cart-toast" role="status" aria-live="polite"></div>');
      $toast.text(message || 'Added to cart');
      $('body').append($toast);
      setTimeout(function () {
        $toast.addClass('is-visible');
      }, 10);
      setTimeout(function () {
        $toast.removeClass('is-visible');
        setTimeout(function () {
          $toast.remove();
        }, 250);
      }, 1200);
    };

    var getProductFromTrigger = function ($trigger) {
      var $root = $trigger.closest('.product-card, .product-item, .product-action, .product-info, .product-details');
      if ($root.length === 0) $root = $trigger.closest('body');
      var $page = $trigger.closest('body');

      var name =
        $root.find('.card-title a').first().text().trim() ||
        $root.find('.product-title').first().text().trim() ||
        $root.find('h3 a').first().text().trim() ||
        $root.find('h2').first().text().trim();

      if (!name) {
        name =
          $page.find('.product-title').first().text().trim() ||
          $page.find('.card-title a').first().text().trim();
      }

      var priceText =
        $trigger.find('span').first().text().trim() ||
        $root.find('.money').first().text().trim() ||
        $root.find('.product-price .fs-2').first().text().trim();
      var price = parseMoney(priceText);

      if ((!Number.isFinite(price) || price <= 0) && $page.length) {
        price = parseMoney($page.find('.product-price .fs-2').first().text().trim());
      }

      var image =
        $root.find('img.product-image').first().attr('src') ||
        $root.find('.image-holder img').first().attr('src') ||
        $root.find('img').first().attr('src') ||
        '';

      if (!image && $page.length) {
        image =
          $page.find('.product-large-slider img').first().attr('src') ||
          $page.find('img').first().attr('src') ||
          '';
      }

      var url =
        $root.find('.card-title a').first().attr('href') ||
        $root.find('a[href$=\".html\"]').first().attr('href') ||
        '/single-product';

      var productId =
        $trigger.data('productId') ||
        $root.find('[data-product-id]').first().data('productId') ||
        $page.find('[data-product-id]').first().data('productId');

      if (!productId) return null;

      return {
        id: String(productId),
        name: name,
        price: price,
        image: image,
        url: url
      };
    };

    var updateCartBadge = function () {
      var count = cartState.items.reduce(function (sum, it) {
        return sum + (parseInt(it.quantity, 10) || 0);
      }, 0);

      var $cartLink = $('.user-items a[href$=\"/cart\"], .user-items a[href$=\"cart.html\"]').first();
      if ($cartLink.length === 0) return;

      var $badge = $cartLink.find('.cart-count-badge').first();
      if (count <= 0) {
        if ($badge.length) $badge.remove();
        return;
      }

      if ($badge.length === 0) {
        $badge = $('<span class=\"cart-count-badge\" aria-label=\"Cart items count\"></span>');
        $cartLink.append($badge);
      }
      $badge.text(String(count));
    };

    // Add-to-cart click handlers
    $(document).on('click', 'a[data-after][data-product-id], button.product-cart-submit, #add-to-cart-btn', function (e) {
      var $trigger = $(this);
      var isButton = $trigger.is('button') || $trigger.is('#add-to-cart-btn') || $trigger.hasClass('product-cart-submit');

      var after = String($trigger.attr('data-after') || '');
      var looksLikeAdd = isButton || /add\s*to\s*cart/i.test(after) || !!$trigger.data('productId');
      if (!looksLikeAdd) return;

      e.preventDefault();

      var product = getProductFromTrigger($trigger);
      if (!product) return;

      // Single product page quantity
      var qty = 1;
      var $qtyInput = $trigger.closest('.product-action, .product-details, body').find('.product-qty input[name=\"quantity\"]').first();
      if ($qtyInput.length) qty = parseInt($qtyInput.val(), 10) || 1;

      addToCart(product.id, qty)
        .then(function () {
          if ($('#cart-page').length) {
            return syncCartState();
          }
        })
        .then(function () {
          updateCartBadge();
          showCartToast((product.name || 'Product') + ' added to cart');
        })
        .catch(function (err) {
          showCartToast(err.message || 'Unable to add item');
        });

      // quick feedback
      if ($trigger.is('a')) {
        var originalAfter = $trigger.attr('data-after');
        if (originalAfter) {
          $trigger.attr('data-after', 'Added!');
          setTimeout(function () {
            $trigger.attr('data-after', originalAfter);
          }, 900);
        }
      }

      var href = $trigger.attr('href');
      if (href && href !== '#' && href.trim() !== '') {
        window.location.href = href;
      }
    });

    // cart page (responsive totals + live quantity updates)
    var initCartPage = function () {
      if ($('#cart-page').length === 0) return;

      var getQty = function ($item) {
        var $input = $item.find('.product-qty input[name="quantity"]').first();
        var qty = parseInt($input.val(), 10);
        if (!Number.isFinite(qty) || qty < 1) qty = 1;
        $input.val(qty);
        return qty;
      };

      var getUnitPrice = function ($item) {
        var $price = $item.find('.card-price .money').first();
        return parseMoney($price.text());
      };

      var updateLine = function ($item) {
        var qty = getQty($item);
        var unit = getUnitPrice($item);
        var lineTotal = unit * qty;

        var $lineTotalEl = $item.find('[data-cart-line-total]').first();
        if ($lineTotalEl.length) {
          $lineTotalEl.text(formatMoney(lineTotal));
        } else {
          $item.find('.total-price .money').first().text(formatMoney(lineTotal));
        }
      };

      var renderEmptyState = function () {
        var $table = $('#cart-page .cart-table').first();
        if ($table.length === 0) return;

        var hasItems = $table.find('[data-cart-item]').length > 0;
        var $empty = $table.find('.cart-empty').first();

        if (hasItems) {
          if ($empty.length) $empty.remove();
          return;
        }

        if ($empty.length === 0) {
          $table.append('<div class="cart-empty text-center py-5"><h5 class="mb-0">Your cart is empty.</h5></div>');
        }
      };

      var updateTotals = function () {
        recalculateCartState();
        $('.cart-subtotal-amount').text(Number(cartState.subtotal || 0).toFixed(2));
        $('.cart-total-amount').text(Number(cartState.total || 0).toFixed(2));
      };

      var refreshCartPage = function () {
        renderItems();
        updateTotals();
        renderEmptyState();
        updateCartBadge();
      };

      var renderItems = function () {
        var $mount = $('#cart-page [data-cart-items]').first();
        if ($mount.length === 0) return;

        $mount.empty();

        cartState.items.forEach(function (it) {
          var safeQty = parseInt(it.quantity, 10);
          if (!Number.isFinite(safeQty) || safeQty < 1) safeQty = 1;

          var html = ''
            + '<div class=\"cart-item border-top border-bottom py-5\" data-cart-item data-cart-id=\"' + it.product_id + '\">'
            + '  <div class=\"row align-items-center\">'
            + '    <div class=\"col-lg-4 col-md-3 col-sm-3\">'
            + '      <div class=\"cart-info d-flex flex-wrap align-items-center mb-4\">'
            + '        <div class=\"col-4 col-lg-5\">'
            + '          <div class=\"card-image\">'
            + '            <img src=\"' + (it.image || '/assets/images/product-thumb-1.jpg') + '\" alt=\"' + it.name + '\" class=\"img-fluid\">'
            + '          </div>'
            + '        </div>'
            + '        <div class=\"col-8 col-lg-7\">'
            + '          <div class=\"card-detail ps-3\">'
            + '            <h5 class=\"card-title\"><a href=\"' + (it.url || '/single-product') + '\" class=\"text-decoration-none\">' + it.name + '</a></h5>'
            + '            <div class=\"card-price\"><span class=\"money text-dark\">' + formatMoney(it.price) + '</span></div>'
            + '          </div>'
            + '        </div>'
            + '      </div>'
            + '    </div>'
            + '    <div class=\"col-lg-7 col-md-7 col-sm-7\">'
            + '      <div class=\"row d-flex\">'
            + '        <div class=\"col-6 col-lg-6 col-md-6 col-sm-6\">'
            + '          <div class=\"input-group product-qty me-3 border\" style=\"max-width: 150px;\">'
            + '            <span class=\"input-group-btn\">'
            + '              <button type=\"button\" class=\"quantity-left-minus btn btn-number\" data-type=\"minus\" data-field=\"\">'
            + '                <svg width=\"16\" height=\"16\"><use xlink:href=\"#minus\"></use></svg>'
            + '              </button>'
            + '            </span>'
            + '            <input type=\"text\" name=\"quantity\" class=\"form-control input-number text-center bg-gray-1\" value=\"' + safeQty + '\" min=\"1\" max=\"100\">'
            + '            <span class=\"input-group-btn\">'
            + '              <button type=\"button\" class=\"quantity-right-plus btn btn-number\" data-type=\"plus\" data-field=\"\">'
            + '                <svg width=\"16\" height=\"16\"><use xlink:href=\"#plus\"></use></svg>'
            + '              </button>'
            + '            </span>'
            + '          </div>'
            + '        </div>'
            + '        <div class=\"col-6 col-lg-6 col-md-6 col-sm-6\">'
            + '          <div class=\"total-price py-3\"><span class=\"money text-dark\" data-cart-line-total>' + formatMoney(it.line_total) + '</span></div>'
            + '        </div>'
            + '      </div>'
            + '    </div>'
            + '    <div class=\"col-12 col-lg-1 col-md-2 col-sm-1 text-end\">'
            + '      <div class=\"cart-remove\"><a href=\"#\" aria-label=\"Remove item from cart\">'
            + '        <svg class=\"trash\" width=\"30px\" height=\"30px\"><use xlink:href=\"#trash\"></use></svg>'
            + '      </a></div>'
            + '    </div>'
            + '  </div>'
            + '</div>';

          $mount.append(html);
        });
      };

      syncCartState().then(function () {
        refreshCartPage();
      });

      // Quantity changes
      $('#cart-page').on('change', '.product-qty input[name="quantity"]', function () {
        var $item = $(this).closest('[data-cart-item]');
        var id = String($item.data('cartId') || '');
        if (!id) return;

        var nextQty = getQty($item);
        cartState.items = cartState.items.map(function (item) {
          if (String(item.product_id) === id) {
            item.quantity = nextQty;
            item.line_total = (Number(item.price) || 0) * nextQty;
          }
          return item;
        });
        refreshCartPage();

        setCartQty(id, nextQty)
          .then(function () {
            refreshCartPage();
          })
          .catch(function (err) {
            showCartToast(err.message || 'Unable to update quantity');
            syncCartState().then(function () {
              refreshCartPage();
            });
          });
      });

      // Remove item
      $('#cart-page').on('click', '.cart-remove a', function (e) {
        e.preventDefault();
        var $item = $(this).closest('[data-cart-item]');
        var id = String($item.data('cartId') || '');
        if (!id) return;

        cartState.items = cartState.items.filter(function (item) {
          return String(item.product_id) !== id;
        });
        refreshCartPage();

        removeCartItem(id)
          .then(function () {
            refreshCartPage();
          })
          .catch(function (err) {
            showCartToast(err.message || 'Unable to remove item');
            syncCartState().then(function () {
              refreshCartPage();
            });
          });
      });
    };
    initCartPage();

    // cart page buttons
    $(document).on('click', '[data-cart-action=\"continue-shopping\"]', function () {
      window.location.href = '/shop';
    });
    $(document).on('click', '[data-cart-action=\"checkout\"]', function () {
      window.location.href = '/checkout';
    });
    $(document).on('click', '[data-cart-action=\"update\"]', function () {
      syncCartState().then(function () {
        showCartToast('Cart updated');
      });
    });

    var initCheckoutPage = function () {
      var $form = $('.checkout-wrap form').first();
      if ($form.length === 0) return;
      var checkoutSummary = {
        couponCode: '',
        discount: 0,
        subtotal: 0,
        shipping: 0,
        tax: 0,
        total: 0
      };

      var renderCheckoutTotals = function () {
        $('.checkout-subtotal-amount').text(Number(checkoutSummary.subtotal || 0).toFixed(2));
        $('.checkout-discount-amount').text(Number(checkoutSummary.discount || 0).toFixed(2));
        $('.checkout-shipping-amount').text(Number(checkoutSummary.shipping || 0).toFixed(2));
        $('.checkout-tax-amount').text(Number(checkoutSummary.tax || 0).toFixed(2));
        $('.checkout-total-amount').text(Number(checkoutSummary.total || 0).toFixed(2));
      };

      var resetCouponFeedback = function (message, isError) {
        var $feedback = $('[data-coupon-feedback]').first();
        if ($feedback.length === 0) return;
        $feedback.text(message || '');
        $feedback.toggleClass('text-danger', !!isError);
        $feedback.toggleClass('text-success', !isError && !!message);
        if (!message) {
          $feedback.removeClass('text-danger text-success');
        }
      };

      fetchCart()
        .then(function () {
          checkoutSummary.subtotal = Number(cartState.subtotal || 0);
          checkoutSummary.shipping = Number(cartState.shipping || 0);
          checkoutSummary.tax = Number(cartState.tax || 0);
          checkoutSummary.total = Number(cartState.total || 0);
          renderCheckoutTotals();
        });

      var applyCouponForSelectedShipping = function (code) {
        return applyCoupon(code, String($('input[name="shipping_method"]:checked').val() || 'standard'));
      };

      $('#apply-coupon-btn').on('click', function () {
        var code = String($('#coupon-code').val() || '').trim();

        if (!code) {
          checkoutSummary.couponCode = '';
          checkoutSummary.discount = 0;
          checkoutSummary.shipping = Number(cartState.shipping || checkoutSummary.shipping || 0);
          checkoutSummary.tax = Number(cartState.tax || checkoutSummary.tax || 0);
          checkoutSummary.total = Number(cartState.total || checkoutSummary.total || checkoutSummary.subtotal || 0);
          renderCheckoutTotals();
          resetCouponFeedback('Enter a coupon code first.', true);
          return;
        }

        applyCouponForSelectedShipping(code)
          .then(function (data) {
            checkoutSummary.couponCode = data.coupon_code || code;
            checkoutSummary.discount = Number(data.discount || 0);
            checkoutSummary.subtotal = Number(data.subtotal || checkoutSummary.subtotal || 0);
            checkoutSummary.shipping = Number(data.shipping || 0);
            checkoutSummary.tax = Number(data.tax || 0);
            checkoutSummary.total = Number(data.total || checkoutSummary.total || 0);
            renderCheckoutTotals();
            resetCouponFeedback('Coupon applied: ' + checkoutSummary.couponCode, false);
          })
          .catch(function (err) {
            checkoutSummary.couponCode = '';
            checkoutSummary.discount = 0;
            checkoutSummary.shipping = Number(cartState.shipping || 0);
            checkoutSummary.tax = Number(cartState.tax || 0);
            checkoutSummary.total = Number(cartState.total || checkoutSummary.subtotal || 0);
            renderCheckoutTotals();
            resetCouponFeedback(err.message || 'Coupon could not be applied.', true);
          });
      });

      $(document).on('change', 'input[name="shipping_method"]', function () {
        var code = String($('#coupon-code').val() || '').trim();

        applyCouponForSelectedShipping(code)
          .then(function (data) {
            checkoutSummary.couponCode = data.coupon_code || code;
            checkoutSummary.discount = Number(data.discount || 0);
            checkoutSummary.subtotal = Number(data.subtotal || checkoutSummary.subtotal || 0);
            checkoutSummary.shipping = Number(data.shipping || 0);
            checkoutSummary.tax = Number(data.tax || 0);
            checkoutSummary.total = Number(data.total || checkoutSummary.total || 0);
            renderCheckoutTotals();
            resetCouponFeedback(code ? 'Coupon applied: ' + (data.coupon_code || code) : '', false);
          })
          .catch(function () {
            fetchCart().then(function () {
              checkoutSummary.subtotal = Number(cartState.subtotal || 0);
              checkoutSummary.shipping = Number(cartState.shipping || 0);
              checkoutSummary.tax = Number(cartState.tax || 0);
              checkoutSummary.total = Number(cartState.total || 0);
              renderCheckoutTotals();
            });
          });
      });

      $form.on('submit', function (e) {
        e.preventDefault();

        var payload = {
          name: [$('#fname').val(), $('#lname').val()].join(' ').trim(),
          email: $('#email').val(),
          phone: $('#phone').val(),
          address: [
            $('input[name=\"address_line_1\"]').val(),
            $('input[name=\"address_line_2\"]').val(),
            $('#city').val(),
            $('#state').val(),
            $('#zip').val(),
            $('#country').val()
          ].filter(Boolean).join(', '),
          notes: $('textarea[name=\"notes\"]').val(),
          coupon_code: checkoutSummary.couponCode || String($('#coupon-code').val() || '').trim(),
          payment_method: String($('input[name=\"listGroupRadios\"]:checked').val() || 'bank_transfer'),
          shipping_method: String($('input[name=\"shipping_method\"]:checked').val() || 'standard'),
          save_details: $('#save-details').is(':checked')
        };

        checkoutCart(payload)
          .then(function (data) {
            if (data.checkout_url) {
              window.location.href = data.checkout_url;
              return;
            }

            showCartToast('Order ' + data.order_number + ' created');
            window.location.href = '/order-tracking';
          })
          .catch(function (err) {
            showCartToast(err.message || 'Checkout failed');
          });
      });
    };
    initCheckoutPage();

    fetchCart().then(function () {
      updateCartBadge();
    }).catch(function () { });

  }); // End of a document

})(jQuery);
