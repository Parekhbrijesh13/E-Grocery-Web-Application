@extends('User.layouts.master')

@section('title', 'Darshan Super Market - Contact')

@section('content')

    <style>
        /* Contact Page Styling */
        .contact-section {
            background: #f8f9fa;
            padding: 60px 0;
        }

        .contact-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .contact-card {
            border: none;
            border-radius: 12px;
            padding: 25px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .contact-card h4 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: none;
        }

        .btn-custom {
            background: #28a745;
            color: #fff;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #218838;
        }

        .contact-info p {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .whatsapp-btn {
            background: #25D366;
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            display: inline-block;
            text-decoration: none;
            margin-top: 10px;
        }

        .whatsapp-btn:hover {
            background: #1ebe5d;
            color: #fff;
        }

        .map-container iframe {
            border-radius: 12px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contact-section {
                padding: 30px 10px;
            }
        }
    </style>

    <section class="contact-section">
        <div class="container">

            <!-- Heading -->
            <div class="text-center mb-5">
                <h2 class="contact-title">📞 Contact Us</h2>
                <p>We are here to help you! Visit or contact Darshan Super Market</p>
            </div>

            <div class="row">

                <!-- Contact Form -->
                <div class="col-md-6 mb-4">
                    <div class="contact-card">
                        <h4>Send Message</h4>

                        <form action="mailto:darshansupermarket@gmail.com" method="POST" enctype="text/plain">

                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                            </div>

                            <div class="mb-3">
                                <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-custom w-100">Send Message</button>

                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6">

                    <div class="contact-card contact-info mb-4">
                        <h4>Store Info</h4>

                        <p><strong>🏪 Darshan Super Market</strong></p>
                        <p>📍 Amreli, Gujarat, India</p>
                        <p>📞 +91 9XXXXXXXXX</p>
                        <p>📧 darshansupermarket@gmail.com</p>
                        <p>🕒 Open: 8 AM – 10 PM</p>

                        <a href="https://wa.me/919XXXXXXXXX?text=Hello%20Darshan%20Super%20Market" class="whatsapp-btn"
                            target="_blank">
                            💬 Chat on WhatsApp
                        </a>
                    </div>

                    <!-- Google Map -->
                    <div class="contact-card map-container">
                        <iframe src="https://maps.google.com/maps?q=Amreli%20Gujarat&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            width="100%" height="250" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
