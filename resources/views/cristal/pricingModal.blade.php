<div class="row pricing-tables">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="pricing-table table-left wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <div class="icon">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <div class="pricing-details">
                    <h2>Starter Plan</h2>
                    <span>Free</span>
                    <ul>
                        <li>Consectetur adipiscing</li>
                        <li>Nunc luctus nulla et tellus</li>
                        <li>Suspendisse quis metus</li>
                        <li>Vestibul varius fermentum erat</li>
                    </ul>
                </div>
                <div class="plan-button">
                        <button onclick="datasendModal({'url':'{{ route('billingdataformJson', '1') }}'}) ;" class="btn btn-common">Buy Now</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="pricing-table wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <div class="icon">
                    <i class="lnr lnr-heart"></i>
                </div>
                <div class="pricing-details">
                    <h2>Popular Plan</h2>
                    <span>$3.99</span>
                    <ul>
                        <li>Consectetur adipiscing</li>
                        <li>Nunc luctus nulla et tellus</li>
                        <li>Suspendisse quis metus</li>
                        <li>Vestibul varius fermentum erat</li>
                    </ul>
                </div>
                <div class="plan-button">
                        <button onclick="datasendModal({'url':'{{ route('billingdataformJson', '2') }}'}) ;" class="btn btn-common">Buy Now</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="pricing-table table-left wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="0.3s">
                <div class="icon">
                    <i class="lnr lnr-magic-wand"></i>
                </div>
                <div class="pricing-details">
                    <h2>Premium Plan</h2>
                    <span>$9.50</span>
                    <ul>
                        <li>Consectetur adipiscing</li>
                        <li>Nunc luctus nulla et tellus</li>
                        <li>Suspendisse quis metus</li>
                        <li>Vestibul varius fermentum erat</li>
                    </ul>
                </div>
                <div class="plan-button">
                    <button onclick="datasendModal({'url':'{{ route('billingdataformJson', '3') }}'}) ;" class="btn btn-common">Buy Now</button>
                </div>
            </div>
        </div>

    </div>
