@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Cart')

@section('storefront_content')
<section id="cart-page" class="pt-5">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-8 col-md-12 mb-5">
          <div class="cart-table">
            <div class="cart-header">
              <div class="d-flex justify-content-between">
                <h6 class="cart-title text-uppercase text-muted col-lg-4 col-md-4 col-sm-4 pb-3">Product</h6>
                <h6 class="cart-title text-uppercase text-muted col-lg-4 col-md-4 col-sm-4 pb-3">Quantity</h6>
                <h6 class="cart-title text-uppercase text-muted col-lg-4 col-md-4 col-sm-4 pb-3">Subtotal</h6>
              </div>
            </div>

            <div class="cart-items" data-cart-items></div>

          </div>
        </div>

        <div class="col-lg-4 col-md-12">
          <div class="cart-totals">
            <h4 class="text-dark pb-4">Cart Total</h4>
            <div class="total-price pb-5">
              <table cellspacing="0" class="table text-uppercase">
                <tbody>
                  <tr class="subtotal pt-2 pb-2 border-top border-bottom">
                    <th>Subtotal</th>
                    <td data-title="Subtotal">
                      <span class="price-amount amount text-dark ps-5">
                        <bdi>
                          <span class="price-currency-symbol">$</span><span class="cart-subtotal-amount">410.00</span>
                        </bdi>
                      </span>
                    </td>
                  </tr>
                  <tr class="order-total pt-2 pb-2 border-bottom">
                    <th>Total</th>
                    <td data-title="Total">
                      <span class="price-amount amount text-dark ps-5">
                        <bdi>
                          <span class="price-currency-symbol">$</span><span class="cart-total-amount">410.00</span></bdi>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="button-wrap row">
              <div class="col-lg-6 col-md-6 mb-3"><button type="button" data-cart-action="update"
                  class="btn btn-dark text-uppercase btn-rounded-none w-100">Update Cart</button></div>
              <div class="col-lg-6 col-md-6 mb-3"><button type="button" data-cart-action="continue-shopping"
                  class="btn btn-dark text-uppercase btn-rounded-none w-100">Continue Shopping</button></div>
              <div class="col-lg-12 col-md-12"><button type="button" data-cart-action="checkout"
                  class="btn btn-primary text-uppercase btn-rounded-none w-100">Proceed to checkout</button></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
