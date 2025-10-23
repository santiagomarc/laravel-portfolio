{{-- filepath: resources/views/resume/partials/_contact.blade.php --}}
<section id="contact">
    <h2>Get In Touch</h2>
    <p>Feel free to reach out for collaboration opportunities or just to say hello!</p>
    <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
        @csrf
        <div class="form-row">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
        </div>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
    <div id="form-response"></div>
</section>
