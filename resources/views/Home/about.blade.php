@extends('User.layouts.master')

@section('title', 'Darshan Super Market - About')

@section('content')

    <style>
        .about-section {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .about-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .about-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .about-text {
            font-size: 16px;
            color: #555;
            line-height: 1.7;
        }

        .about-highlight {
            color: #28a745;
            font-weight: 600;
        }

        .about-img {
            width: 100%;
            border-radius: 12px;
        }

        .feature-box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 30px;
            color: #28a745;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .about-section {
                padding: 30px 10px;
            }
        }
    </style>

    <section class="about-section">
        <div class="container">

            <!-- Heading -->
            <div class="text-center mb-5">
                <h2 class="about-title">About Us</h2>
                <p>Your trusted local grocery store in Amreli</p>
            </div>

            <div class="row align-items-center">

                <!-- Image -->
                <div class="col-md-6 mb-4">
                    <img src="{{ asset('assets/images/Aboutus.webp') }}" alt="Store Image" class="about-img">
                </div>

                <!-- Content -->
                <div class="col-md-6">
                    <div class="about-card">
                        <p class="about-text">
                            Welcome to <span class="about-highlight">Darshan Super Market</span>, your one-stop destination
                            for fresh groceries, daily essentials, and quality products in Amreli.
                        </p>

                        <p class="about-text">
                            We are committed to providing our customers with the best products at affordable prices.
                            From fresh fruits and vegetables to household items, we ensure quality and satisfaction.
                        </p>

                        <p class="about-text">
                            Our goal is to make your shopping experience easy, fast, and convenient.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Features -->
            <div class="row text-center mt-4">

                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">🛒</div>
                        <h5>Wide Range</h5>
                        <p>All daily grocery items available in one place</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">🚚</div>
                        <h5>Fast Delivery</h5>
                        <p>Quick home delivery in Amreli area</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">💰</div>
                        <h5>Best Prices</h5>
                        <p>Affordable pricing with daily offers</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5 bg-white">
        <div class="container text-center">

            <h3 class="mb-4">Our Mission & Vision</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="about-card">
                        <h5>🎯 Our Mission</h5>
                        <p class="about-text">
                            To provide fresh, high-quality groceries at affordable prices while ensuring excellent
                            customer service for every family in Amreli.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="about-card">
                        <h5>👁️ Our Vision</h5>
                        <p class="about-text">
                            To become the most trusted and preferred supermarket in Amreli by delivering quality,
                            convenience, and value to our customers.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Why Choose Us -->
    <section class="py-5" style="background:#f8f9fa;">
        <div class="container text-center">

            <h3 class="mb-4">Why Choose Us?</h3>

            <div class="row">

                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🥦</div>
                        <h6>Fresh Products</h6>
                        <p>Daily fresh fruits & vegetables</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🏷️</div>
                        <h6>Best Deals</h6>
                        <p>Exciting daily offers & discounts</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">⚡</div>
                        <h6>Quick Service</h6>
                        <p>Fast billing & delivery</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">🤝</div>
                        <h6>Trusted Store</h6>
                        <p>Loved by local customers</p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- Store Highlights -->
    <section class="py-5 bg-white">
        <div class="container text-center">

            <h3 class="mb-4">Store Highlights</h3>

            <div class="row">

                <div class="col-md-4">
                    <div class="about-card">
                        <h4>500+</h4>
                        <p class="about-text">Products Available</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-card">
                        <h4>1000+</h4>
                        <p class="about-text">Happy Customers</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-card">
                        <h4>5★</h4>
                        <p class="about-text">Customer Satisfaction</p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- Call To Action -->
    <section class="py-5 text-center" style="background:#28a745; color:#fff;">
        <div class="container">

            <h3>Visit Darshan Super Market Today!</h3>
            <p>Experience quality shopping with best prices and fresh products</p>

            <a href="https://wa.me/919XXXXXXXXX?text=Hello%20Darshan%20Super%20Market" class="btn btn-light mt-2">
                Order on WhatsApp
            </a>

        </div>
    </section>

@endsection
