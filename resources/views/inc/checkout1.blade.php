 <!-- Main Container -->
  <section class="main-container col2-right-layout bounceInUp animated">
    <div class="main container">
      <div class="row">
        <div class="col-main col-sm-9">
          <div class="page-title">
            <h1>Checkout</h1>
          </div>
          <ol class="one-page-checkout" id="checkoutSteps">
            <li id="opc-login" class="section">
              <div class="step-title"> <span class="number">1</span>
                <h3 class="one_page_heading">Checkout Method</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
            </li>
            <li id="opc-billing" class="section allow active">
              <div class="step-title"> <span class="number">2</span>
                <h3 class="one_page_heading">Billing Information</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              <div id="checkout-step-billing" class="step a-item">
                <form id="co-billing-form" action="">
                  <fieldset class="group-select">
                    <ul>
                      <li id="billing-new-address-form">
                        <fieldset>
                          <legend>New Address</legend>
                          <input type="hidden"  id="billing:address_id" />
                          <ul>
                            <li>
                              <div class="customer-name">
                                <div class="input-box name-firstname">
                                  <label for="billing:firstname"> First Name<span class="required">*</span></label>
                                  <br />
                                  <input type="text" id="billing:firstname" name="" title="First Name" class="input-text" />
                                </div>
                                <div class="input-box name-lastname">
                                  <label for="billing:lastname"> Last Name<span class="required">*</span> </label>
                                  <br />
                                  <input type="text" id="billing:lastname" name="" title="Last Name" class="input-text" />
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="billing:company">Company</label>
                                <br />
                                <input type="text" id="billing:company" name="" title="Company" class="input-text" />
                              </div>
                              <div class="input-box">
                                <label for="billing:email">Email Address <span class="required">*</span></label>
                                <br />
                                <input type="text" name="billing[email]" id="billing:email" title="Email Address" class="input-text" />
                              </div>
                            </li>
                            <li>
                              <label for="billing:street1">Address <span class="required">*</span></label>
                              <br />
                              <input type="text" title="Street Address" name="" id="billing:street1  street1" class="input-text" />
                            </li>
                            <li>
                              <input type="text" title="Street Address 2" name="" id="billing:street2 street2" class="input-text" />
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="billing:city">City <span class="required">*</span></label>
                                <br />
                                <input type="text" title="City" name="" class="input-text" id="billing:city" />
                              </div>
                              <div id="div" class="input-box">
                                <label for="billing:region">State/Province <span class="required">*</span></label>
                                <br />
                                <select defaultvalue="" id="billing:region_id" name="" title="State/Province" class="validate-select">
                                  <option>Please select region, state or province</option>
                                  <option value="1">Alabama</option>
                                  <option value="2">Alaska</option>
                                  <option value="3">American Samoa</option>
                                </select>
                              </div>
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="billing:telephone">Telephone <span class="required">*</span></label>
                                <br />
                                <input type="text" name="" title="Telephone" class="input-text" id="billing:telephone" />
                              </div>
                              <div class="input-box">
                                <label for="billing:fax">Fax</label>
                                <br />
                                <input type="text" name="" title="Fax" class="input-text" id="billing:fax" />
                              </div>
                            </li>
                            <li id="register-customer-password">
                              <div class="input-box">
                                <label for="billing:customer_password">Password <span class="required">*</span></label>
                                <br />
                                <input type="password" name="" id="billing:customer_password" title="Password" class="input-text" />
                              </div>
                              <div class="input-box">
                                <label for="billing:confirm_password">Confirm Password <span class="required">*</span></label>
                                <br />
                                <input type="password" name="" title="Confirm Password" id="billing:confirm_password" class="input-text" />
                              </div>
                            </li>
                            <li>
                              <input type="hidden" name="" value="1" />
                            </li>
                          </ul>
                        </fieldset>
                      </li>
                      <li class="control">
                        <input type="radio" class="radio" onClick="#" title="Ship to this address" checked="checked" value="1" id="billing:use_for_shipping_yes" name="">
                        <label for="billing:use_for_shipping_yes">Ship to this address</label>
                      </li>
                      <li class="control">
                        <input type="radio" class="radio" onClick="#" title="Ship to different address" value="0" id="billing:use_for_shipping_no" name="">
                        <label for="billing:use_for_shipping_no">Ship to different address</label>
                      </li>
                    </ul>
                    <p class="require"><em class="required">* </em>Required Fields</p>
                    <button type="button" class="button continue" onClick="#"><span>Continue</span></button>
                  </fieldset>
                </form>
              </div>
            </li>
            <li id="opc-shipping" class="section">
              <div class="step-title"> <span class="number">3</span>
                <h3 class="one_page_heading">Shipping Information</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              <div id="checkout-step-shipping" class="step a-item" style="display: none;">
                <form action="" id="co-shipping-form">
                  <fieldset class="group-select">
                    <ul>
                      <li id="shipping-new-address-form">
                        <fieldset>
                          <input type="hidden" name="" value="9681" id="shipping:address_id" />
                          <ul>
                            <li>
                              <div class="customer-name">
                                <div class="input-box name-firstname">
                                  <label for="shipping:firstname"> First Name <span class="required">*</span> </label>
                                  <br />
                                  <input type="text" id="shipping:firstname" name="" title="First Name" class="input-text" onChange="#" />
                                </div>
                                <div class="input-box name-lastname">
                                  <label for="shipping:lastname"> Last Name <span class="required">*</span> </label>
                                  <br />
                                  <input type="text" id="shipping:lastname" name="" title="Last Name" class="input-text" onChange="#" />
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="shipping:company">Company</label>
                                <br />
                                <input type="text" id="shipping:company" name="shipping[company]" title="Company" class="input-text" onChange="#" />
                              </div>
                            </li>
                            <li>
                              <label for="shipping:street1">Address <span class="required">*</span></label>
                              <br />
                              <input type="text" title="Street Address" name="shipping[street][]" id="shipping:street1" class="input-text" onChange="#" />
                            </li>
                            <li>
                              <input type="text" title="Street Address 2" name="shipping[street][]" id="shipping:street2" class="input-text" onChange="#" />
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="shipping:city">City <span class="required">*</span></label>
                                <br />
                                <input type="text" title="City" name="shipping[city]" class="input-text" id="shipping:city" onChange="#" />
                              </div>
                              <div id="div" class="input-box">
                                <label for="shipping:region">State/Province <span class="required">*</span></label>
                                <br />
                                <select defaultvalue="" id="shipping:region_id" name="shipping[region_id]" title="State/Province" class="validate-select" style="">
                                  <option>Please select region, state or province</option>
                                  <option value="1">Alabama</option>
                                  <option value="2">Alaska</option>
                                  <option value="3">American Samoa</option>
                                </select>
                                <input type="text" id="shipping:region" name="" title="State/Province" class="input-text" style="display: none;" />
                              </div>
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="shipping:postcode">Zip/Postal Code <span class="required">*</span></label>
                                <br />
                                <input type="text" title="Zip/Postal Code" name="" id="shipping:postcode" class="input-text" />
                              </div>
                              <div class="input-box">
                                <label for="shipping:country_id">Country <span class="required">*</span></label>
                                <br />
                                <select name="" id="shipping:country_id" class="validate-select" title="Country" onChange="#">
                                  <option> </option>
                                  <option value="AF">Afghanistan</option>
                                  <option value="AL">Albania</option>
                                  <option value="DZ">Algeria</option>
                                </select>
                              </div>
                            </li>
                            <li>
                              <div class="input-box">
                                <label for="shipping:telephone">Telephone <span class="required">*</span></label>
                                <br />
                                <input type="text" name="" title="Telephone" class="input-text" id="shipping:telephone" onChange="#" />
                              </div>
                              <div class="input-box">
                                <label for="shipping:fax">Fax</label>
                                <br />
                                <input type="text" name="" title="Fax" class="input-text" id="shipping:fax" onChange="#" />
                              </div>
                            </li>
                            <li class="no-display">
                              <input type="hidden" name="" value="1" />
                            </li>
                            <li>
                              <input type="checkbox" name="" id="shipping:same_as_billing" value="1" onClick="#" class="checkbox" />
                              <label for="shipping:same_as_billing">Use Billing Address</label>
                            </li>
                          </ul>
                        </fieldset>
                      </li>
                    </ul>
                    <p class="require"><em class="required">* </em>Required Fields</p>
                    <div class="buttons-set1" id="shipping-buttons-container">
                      <button type="button" class="button continue" onClick="shipping.save()"><span>Continue</span></button>
                      <a href="#" onClick="checkout.back(); return false;" class="back-link">« Back</a> </div>
                  </fieldset>
                </form>
              </div>
            </li>
            <li id="opc-shipping_method" class="section">
              <div class="step-title"> <span class="number">4</span>
                <h3 class="one_page_heading">Shipping Method</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              <div id="checkout-step-shipping_method" class="step a-item" style="display: none;">
                <form id="co-shipping-method-form" action="">
                  <fieldset>
                    <div id="checkout-shipping-method-load">
                      <p>Sorry, no quotes are available for this order at this time.</p>
                    </div>
                    <div id="onepage-checkout-shipping-method-additional-load">
                      <div class="add-gift-message">
                        <h4>Do you have any gift items in your order?</h4>
                        <p>
                          <input type="checkbox" name="" id="allow_gift_messages" value="1" onClick="toogleVisibilityOnObjects(this, ['allow-gift-message-container']);" class="checkbox" />
                          <label for="allow_gift_messages">Check this checkbox if you want to add gift messages.</label>
                        </p>
                      </div>
                      <div style="display: none;" class="gift-message-form" id="allow-gift-message-container">
                        <div class="inner-box"> </div>
                      </div>
                    </div>
                    <div class="buttons-set1" id="shipping-method-buttons-container">
                      <button type="button" class="button continue" onClick="shippingMethod.save()"><span>Continue</span></button>
                      <a href="#" onClick="checkout.back(); return false;" class="back-link">« Back</a> </div>
                  </fieldset>
                </form>
              </div>
            </li>
            <li id="opc-payment" class="section">
              <div class="step-title"> <span class="number">5</span>
                <h3 class="one_page_heading">Payment Information</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              <div id="checkout-step-payment" class="step a-item" style="display: none;">
                <form action="" id="co-payment-form">
                  <dl id="checkout-payment-method-load">
                    <dt>
                      <input type="radio" id="p_method_checkmo" value="checkmo" name="" title="Check / Money order" onClick="payment.switchMethod('checkmo')" class="radio" />
                      <label for="p_method_checkmo">Check / Money order</label>
                    </dt>
                    <dd>
                      <fieldset class="form-list">
                      </fieldset>
                    </dd>
                    <dt>
                      <input type="radio" id="p_method_ccsave" value="ccsave" name="" title="Credit Card (saved)" onClick="payment.switchMethod('ccsave')" class="radio" />
                      <label for="p_method_ccsave">Credit Card (saved)</label>
                    </dt>
                    <dd>
                      <fieldset class="form-list">
                        <ul id="payment_form_ccsave" style="display: none;">
                          <li>
                            <div class="input-box">
                              <label for="ccsave_cc_owner">Name on Card <span class="required">*</span></label>
                              <br />
                              <input type="text" disabled="" title="Name on Card" class="input-text" id="ccsave_cc_owner" name="" />
                            </div>
                          </li>
                          <li>
                            <div class="input-box">
                              <label for="ccsave_cc_type">Credit Card Type <span class="required">*</span></label>
                              <br />
                              <select disabled="" id="ccsave_cc_type" name="" class="required-entry validate-cc-type-select">
                                <option>--Please Select--</option>
                                <option value="AE">American Express</option>
                                <option value="VI">Visa</option>
                                <option value="MC">MasterCard</option>
                                <option value="DI">Discover</option>
                              </select>
                            </div>
                          </li>
                          <li>
                            <div class="input-box">
                              <label for="ccsave_cc_number">Credit Card Number <span class="required">*</span></label>
                              <br />
                              <input type="text" disabled="" id="ccsave_cc_number" name="" title="Credit Card Number" class="input-text validate-cc-number validate-cc-type" />
                            </div>
                          </li>
                          <li>
                            <div class="input-box">
                              <label for="ccsave_expiration">Expiration Date <span class="required">*</span></label>
                              <br />
                              <div class="v-fix">
                                <select disabled="" id="ccsave_expiration" style="width: 140px;" name="" class="required-entry">
                                  <option selected="selected">Month</option>
                                  <option value="1">01 - January</option>
                                  <option value="2">02 - February</option>
                                  <option value="3">03 - March</option>
                                  <option value="4">04 - April</option>
                                </select>
                              </div>
                              <div class="v-fix">
                                <select disabled="" id="ccsave_expiration_yr" style="width: 103px;" name="" class="required-entry">
                                  <option selected="selected">Year</option>
                                  <option value="2011">2011</option>
                                  <option value="2012">2012</option>
                                  <option value="2013">2013</option>
                                  <option value="2014">2014</option>
                                  <option value="2015">2015</option>
                                </select>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="input-box">
                              <label for="ccsave_cc_cid">Card Verification Number <span class="required">*</span></label>
                              <br />
                              <div class="v-fix">
                                <input type="text" disabled="" title="Card Verification Number" class="input-text" id="ccsave_cc_cid" name="" style="width: 3em;" />
                              </div>
                              <a href="#" class="cvv-what-is-this">What is this?</a> </div>
                          </li>
                        </ul>
                      </fieldset>
                    </dd>
                  </dl>
                </form>
                <p class="require"><em class="required">* </em>Required Fields</p>
                <div class="buttons-set1" id="payment-buttons-container">
                  <button type="button" class="button continue" onClick="#"><span>Continue</span></button>
                  <a href="#" onClick="checkout.back(); return false;" class="back-link">« Back</a> </div>
                <div style="clear: both;"></div>
              </div>
            </li>
            <li id="opc-review" class="section">
              <div class="step-title"> <span class="number">6</span>
                <h3 class="one_page_heading">Order Review</h3>
                <!--<a href="#">Edit</a>--> 
              </div>
              <div id="checkout-step-review" class="step a-item" style="display: none;">
                <div class="order-review" id="checkout-review-load"> </div>
                <div class="buttons-set13" id="review-buttons-container">
                  <p class="f-left">Forgot an Item? <a href="#">Edit Your Cart</a></p>
                  <button type="submit" class="button" onClick="#"><span>Place Order</span></button>
                </div>
              </div>
            </li>
          </ol>
        </div>
        <aside class="col-right sidebar col-sm-3">
          <div class="block block-progress">
            <div class="block-title ">Your Checkout</div>
            <div class="block-content">
              <dl>
                <dt class="complete"> Billing Address <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete">
                  <address>
                  John Deo<br>
                  Better Technology Labs.<br>
                  23 North Main Stree<br>
                  Windsor<br>
                  Holtsville,  New York, 00501<br>
                  United States<br>
                  T: 5465465 <br>
                  F: 466523
                  </address>
                </dd>
                <dt class="complete"> Shipping Address <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete">
                  <address>
                  John Deo<br>
                  Better Technology Labs.<br>
                  23 North Main Stree<br>
                  Windsor<br>
                  Holtsville,  New York, 00501<br>
                  United States<br>
                  T: 5465465 <br>
                  F: 466523
                  </address>
                </dd>
                <dt class="complete"> Shipping Method <span class="separator">|</span> <a href="#">Change</a> </dt>
                <dd class="complete"> Flat Rate - Fixed <br>
                  <span class="price">$15.00</span> </dd>
                <dt> Payment Method </dt>
              </dl>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>
  <!-- Main Container end --> 

