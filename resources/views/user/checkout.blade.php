@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Checkout')

@section('storefront_content')
<section class="checkout-wrap pt-5">
    <div class="container-fluid">
      @if(request('stripe') === 'success')
        <div class="alert alert-success mb-4">Stripe payment completed. Your order is being processed.</div>
      @elseif(request('stripe') === 'cancelled')
        <div class="alert alert-warning mb-4">Stripe checkout was cancelled. Your order is still pending payment.</div>
      @endif
      <form class="form-group">
        <div class="row g-5">
          <div class="col-lg-6 col-md-6">
            <h4 class="text-dark pb-4">Billing Details</h4>
            <div class="billing-details">
              <label for="fname">First Name*</label>
              <input type="text" id="fname" name="firstname" class="form-control mt-2 mb-4 ps-3">
              <label for="lname">Last Name*</label>
              <input type="text" id="lname" name="lastname" class="form-control mt-2 mb-4 ps-3">
              <label for="cname">Company Name(optional)*</label>
              <input type="text" id="cname" name="companyname" class="form-control mt-2 mb-4">
              <label for="cname">Country / Region*</label>
              <select id="country" class="form-select form-control mt-2 mb-4" aria-label="Default select example">
                <option selected hidden value="United States">United States</option>
                <option value="United Kingdom">UK</option>
                <option value="Australia">Australia</option>
                <option value="Canada">Canada</option>
              </select>
              <label for="address">Street Address*</label>
              <input type="text" id="adr" name="address_line_1" placeholder="House number and street name"
                class="form-control mt-3 ps-3 mb-3">
              <input type="text" id="adr2" name="address_line_2" placeholder="Appartments, suite, etc."
                class="form-control ps-3 mb-4">
              <label for="city">Town / City *</label>
              <input type="text" id="city" name="city" class="form-control mt-3 ps-3 mb-4">
              <label for="state">State *</label>
              <select id="state" class="form-select form-control mt-2 mb-4" aria-label="Default select example">
                <option selected hidden value="Florida">Florida</option>
                <option value="New York">New York</option>
                <option value="Illinois">Illinois</option>
                <option value="Texas">Texas</option>
                <option value="California">California</option>
                <option value="Georgia">Georgia</option>
              </select>
              <label for="zip">Zip Code *</label>
              <input type="text" id="zip" name="zip" class="form-control mt-2 mb-4 ps-3">
              <label for="email">Phone *</label>
              <input type="text" id="phone" name="phone" class="form-control mt-2 mb-4 ps-3">
              <label for="email">Email address *</label>
              <input type="text" id="email" name="email" class="form-control mt-2 mb-4 ps-3">
              <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" value="1" id="save-details" name="save_details">
                <label class="form-check-label" for="save-details">
                  Save these details to my account for next time
                </label>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <h4 class="text-dark pb-4">Additional Information</h4>
            <div class="billing-details">
              <label for="fname">Order notes (optional)</label>
              <textarea name="notes" class="form-control pt-3 pb-3 ps-3 mt-2"
                placeholder="Notes about your order. Like special notes for delivery."></textarea>
            </div>
            <div class="your-order mt-5">
              <h4 class="display-7 text-dark pb-4">Cart Totals</h4>
              <div class="mb-4">
                <label for="coupon-code" class="form-label">Coupon Code</label>
                <div class="d-flex gap-2">
                  <input type="text" id="coupon-code" name="coupon_code" class="form-control" placeholder="Enter coupon code">
                  <button type="button" class="btn btn-dark text-uppercase" id="apply-coupon-btn">Apply</button>
                </div>
                <div class="small mt-2 text-muted" data-coupon-feedback></div>
              </div>
              <div class="total-price">
                <table cellspacing="0" class="table">
                  <tbody>
                    <tr class="subtotal border-top border-bottom pt-2 pb-2 text-uppercase">
                      <th>Subtotal</th>
                      <td data-title="Subtotal">
                        <span class="price-amount amount ps-5">
                          <bdi>
                            <span class="price-currency-symbol">$</span><span class="checkout-subtotal-amount">0.00</span> </bdi>
                        </span>
                      </td>
                    </tr>
                    <tr class="discount border-bottom pt-2 pb-2 text-uppercase">
                      <th>Discount</th>
                      <td data-title="Discount">
                        <span class="price-amount amount ps-5">
                          <bdi>
                            <span class="price-currency-symbol">-</span><span class="price-currency-symbol">$</span><span class="checkout-discount-amount">0.00</span> </bdi>
                        </span>
                      </td>
                    </tr>
                    <tr class="shipping border-bottom pt-2 pb-2 text-uppercase">
                      <th>Shipping</th>
                      <td data-title="Shipping">
                        <span class="price-amount amount ps-5">
                          <bdi>
                            <span class="price-currency-symbol">$</span><span class="checkout-shipping-amount">0.00</span>
                          </bdi>
                        </span>
                      </td>
                    </tr>
                    <tr class="tax border-bottom pt-2 pb-2 text-uppercase">
                      <th>Tax</th>
                      <td data-title="Tax">
                        <span class="price-amount amount ps-5">
                          <bdi>
                            <span class="price-currency-symbol">$</span><span class="checkout-tax-amount">0.00</span>
                          </bdi>
                        </span>
                      </td>
                    </tr>
                    <tr class="order-total border-bottom pt-2 pb-2 text-uppercase">
                      <th>Total</th>
                      <td data-title="Total">
                        <span class="price-amount amount ps-5">
                          <bdi>
                            <span class="price-currency-symbol">$</span><span class="checkout-total-amount">0.00</span> </bdi>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="list-group mt-5 mb-3">
                  <label class="list-group-item d-flex gap-2 border-0">
                    <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios"
                      id="listGroupRadios1" value="bank_transfer" checked>
                    <span>
                      <strong class="text-uppercase">Direct bank transfer</strong>
                      <small class="d-block text-body-secondary">Make your payment directly into our bank account.
                        Please use your Order ID. Your order will shipped after funds have cleared in our
                        account.</small>
                    </span>
                  </label>
                  <label class="list-group-item d-flex gap-2 border-0">
                    <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios"
                      id="listGroupRadios2" value="cod">
                    <span>
                      <strong class="text-uppercase">Cash on delivery</strong>
                      <small class="d-block text-body-secondary">Pay when the order reaches your delivery address.</small>
                    </span>
                  </label>
                  <label class="list-group-item d-flex gap-2 border-0">
                    <input class="form-check-input flex-shrink-0" type="radio" name="listGroupRadios"
                      id="listGroupRadios3" value="stripe">
                    <span>
                      <strong class="text-uppercase">Stripe</strong>
                      <small class="d-block text-body-secondary">Card payment flow. Configure Stripe keys before using this in production.</small>
                    </span>
                  </label>
                </div>
                <div class="list-group mb-4">
                  <label class="list-group-item d-flex gap-2 border-0">
                    <input class="form-check-input flex-shrink-0" type="radio" name="shipping_method" value="standard" checked>
                    <span>
                      <strong class="text-uppercase">Standard Shipping</strong>
                      <small class="d-block text-body-secondary">$8.00 under $100, free above $100.</small>
                    </span>
                  </label>
                  <label class="list-group-item d-flex gap-2 border-0">
                    <input class="form-check-input flex-shrink-0" type="radio" name="shipping_method" value="express">
                    <span>
                      <strong class="text-uppercase">Express Shipping</strong>
                      <small class="d-block text-body-secondary">$18.00 priority fulfillment.</small>
                    </span>
                  </label>
                </div>
                <button type="submit" name="submit"
                  class="btn btn-dark btn-lg text-uppercase btn-rounded-none w-100">Place an order</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection
