<?php
/**
 * Inquiry Form Template
 *
 * @package TZnew
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get post data if available
$post_id = get_the_ID();
$post_title = get_the_title();
$post_type = get_post_type();
?>

<div class="inquiry-form-container bg-white rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">
    <div class="form-header text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center">
            <i class="fas fa-question-circle text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2"><?php esc_html_e('Send Us an Inquiry', 'tznew'); ?></h2>
        <?php if ($post_title) : ?>
            <p class="text-lg text-gray-600"><?php esc_html_e('Regarding:', 'tznew'); ?> <?php echo esc_html($post_title); ?></p>
        <?php else : ?>
            <p class="text-lg text-gray-600"><?php esc_html_e('We\'re here to help with any questions you may have', 'tznew'); ?></p>
        <?php endif; ?>
    </div>

    <form id="inquiry-form" class="inquiry-form space-y-6" method="post" novalidate>
        <?php wp_nonce_field('tznew_inquiry_nonce', 'inquiry_nonce'); ?>
        
        <!-- Hidden fields -->
        <input type="hidden" name="action" value="tznew_submit_inquiry">
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
        <input type="hidden" name="post_title" value="<?php echo esc_attr($post_title); ?>">
        <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">

        <!-- Contact Information -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user mr-2 text-green-500"></i>
                <?php esc_html_e('Your Information', 'tznew'); ?>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="inquiry_name" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Full Name', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="inquiry_name" name="inquiry_name" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="form-group">
                    <label for="inquiry_email" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Email Address', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="inquiry_email" name="inquiry_email" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="form-group">
                    <label for="inquiry_phone" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Phone Number', 'tznew'); ?>
                    </label>
                    <input type="tel" id="inquiry_phone" name="inquiry_phone" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                </div>
                
                <div class="form-group">
                    <label for="inquiry_country" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Country', 'tznew'); ?>
                    </label>
                    <select id="inquiry_country" name="inquiry_country" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                        <option value=""><?php esc_html_e('Select your country', 'tznew'); ?></option>
                        <option value="US"><?php esc_html_e('United States', 'tznew'); ?></option>
                        <option value="UK"><?php esc_html_e('United Kingdom', 'tznew'); ?></option>
                        <option value="CA"><?php esc_html_e('Canada', 'tznew'); ?></option>
                        <option value="AU"><?php esc_html_e('Australia', 'tznew'); ?></option>
                        <option value="DE"><?php esc_html_e('Germany', 'tznew'); ?></option>
                        <option value="FR"><?php esc_html_e('France', 'tznew'); ?></option>
                        <option value="JP"><?php esc_html_e('Japan', 'tznew'); ?></option>
                        <option value="IN"><?php esc_html_e('India', 'tznew'); ?></option>
                        <option value="NP"><?php esc_html_e('Nepal', 'tznew'); ?></option>
                        <option value="other"><?php esc_html_e('Other', 'tznew'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Inquiry Details -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-comment-dots mr-2 text-blue-500"></i>
                <?php esc_html_e('Your Inquiry', 'tznew'); ?>
            </h3>
            
            <div class="form-group">
                <label for="inquiry_subject" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Subject', 'tznew'); ?> <span class="text-red-500">*</span>
                </label>
                <select id="inquiry_subject" name="inquiry_subject" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" required>
                    <option value=""><?php esc_html_e('Select inquiry type', 'tznew'); ?></option>
                    <option value="general"><?php esc_html_e('General Information', 'tznew'); ?></option>
                    <option value="booking"><?php esc_html_e('Booking Inquiry', 'tznew'); ?></option>
                    <option value="customization"><?php esc_html_e('Trip Customization', 'tznew'); ?></option>
                    <option value="pricing"><?php esc_html_e('Pricing Information', 'tznew'); ?></option>
                    <option value="group"><?php esc_html_e('Group Booking', 'tznew'); ?></option>
                    <option value="permits"><?php esc_html_e('Permits & Documentation', 'tznew'); ?></option>
                    <option value="equipment"><?php esc_html_e('Equipment & Gear', 'tznew'); ?></option>
                    <option value="weather"><?php esc_html_e('Weather & Best Time', 'tznew'); ?></option>
                    <option value="support"><?php esc_html_e('Customer Support', 'tznew'); ?></option>
                    <option value="other"><?php esc_html_e('Other', 'tznew'); ?></option>
                </select>
                <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
            </div>
            
            <div class="form-group mt-4">
                <label for="inquiry_message" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Your Message', 'tznew'); ?> <span class="text-red-500">*</span>
                </label>
                <textarea id="inquiry_message" name="inquiry_message" rows="6" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" placeholder="<?php esc_attr_e('Please provide details about your inquiry. The more information you provide, the better we can assist you...', 'tznew'); ?>" required></textarea>
                <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                <div class="text-sm text-gray-500 mt-1">
                    <?php esc_html_e('Minimum 10 characters required', 'tznew'); ?>
                </div>
            </div>
        </div>

        <!-- Travel Preferences (Optional) -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-map-marked-alt mr-2 text-purple-500"></i>
                <?php esc_html_e('Travel Preferences', 'tznew'); ?> 
                <span class="text-sm font-normal text-gray-500 ml-2">(<?php esc_html_e('Optional', 'tznew'); ?>)</span>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="travel_dates" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Preferred Travel Dates', 'tznew'); ?>
                    </label>
                    <input type="text" id="travel_dates" name="travel_dates" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300" placeholder="<?php esc_attr_e('e.g., March 2024 or Spring 2024', 'tznew'); ?>">
                </div>
                
                <div class="form-group">
                    <label for="group_size_inquiry" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Group Size', 'tznew'); ?>
                    </label>
                    <select id="group_size_inquiry" name="group_size_inquiry" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                        <option value=""><?php esc_html_e('Select group size', 'tznew'); ?></option>
                        <option value="1"><?php esc_html_e('Solo traveler', 'tznew'); ?></option>
                        <option value="2"><?php esc_html_e('2 people', 'tznew'); ?></option>
                        <option value="3-5"><?php esc_html_e('3-5 people', 'tznew'); ?></option>
                        <option value="6-10"><?php esc_html_e('6-10 people', 'tznew'); ?></option>
                        <option value="11-15"><?php esc_html_e('11-15 people', 'tznew'); ?></option>
                        <option value="16+"><?php esc_html_e('16+ people', 'tznew'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label for="budget_range" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Budget Range (per person)', 'tznew'); ?>
                </label>
                <select id="budget_range" name="budget_range" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                    <option value=""><?php esc_html_e('Select budget range', 'tznew'); ?></option>
                    <option value="under-500"><?php esc_html_e('Under $500', 'tznew'); ?></option>
                    <option value="500-1000"><?php esc_html_e('$500 - $1,000', 'tznew'); ?></option>
                    <option value="1000-2000"><?php esc_html_e('$1,000 - $2,000', 'tznew'); ?></option>
                    <option value="2000-3000"><?php esc_html_e('$2,000 - $3,000', 'tznew'); ?></option>
                    <option value="3000-5000"><?php esc_html_e('$3,000 - $5,000', 'tznew'); ?></option>
                    <option value="over-5000"><?php esc_html_e('Over $5,000', 'tznew'); ?></option>
                    <option value="flexible"><?php esc_html_e('Flexible', 'tznew'); ?></option>
                </select>
            </div>
        </div>

        <!-- Contact Preferences -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-phone mr-2 text-indigo-500"></i>
                <?php esc_html_e('Contact Preferences', 'tznew'); ?>
            </h3>
            
            <div class="form-group">
                <label class="form-label block text-sm font-medium text-gray-700 mb-3">
                    <?php esc_html_e('How would you prefer to be contacted?', 'tznew'); ?>
                </label>
                <div class="space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="contact_preference" value="email" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500" checked>
                        <span class="text-sm text-gray-700"><?php esc_html_e('Email (Recommended)', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="contact_preference" value="phone" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Phone Call', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="contact_preference" value="whatsapp" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('WhatsApp', 'tznew'); ?></span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="contact_preference" value="any" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                        <span class="text-sm text-gray-700"><?php esc_html_e('Any method is fine', 'tznew'); ?></span>
                    </label>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label for="response_urgency" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Response Urgency', 'tznew'); ?>
                </label>
                <select id="response_urgency" name="response_urgency" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                    <option value="normal"><?php esc_html_e('Normal (within 24 hours)', 'tznew'); ?></option>
                    <option value="urgent"><?php esc_html_e('Urgent (within 4 hours)', 'tznew'); ?></option>
                    <option value="flexible"><?php esc_html_e('Flexible (within 48 hours)', 'tznew'); ?></option>
                </select>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="form-section">
            <div class="flex items-start space-x-3">
                <input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" class="mt-1 w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500" value="1">
                <label for="newsletter_subscription" class="text-sm text-gray-700">
                    <?php esc_html_e('Subscribe to our newsletter for travel tips, special offers, and updates on new destinations', 'tznew'); ?>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-submit pt-6">
            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane"></i>
                <span><?php esc_html_e('Send Inquiry', 'tznew'); ?></span>
            </button>
            
            <div class="form-loading hidden mt-4 text-center">
                <div class="inline-flex items-center space-x-2 text-green-600">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-green-600"></div>
                    <span><?php esc_html_e('Sending your inquiry...', 'tznew'); ?></span>
                </div>
            </div>
            
            <div class="form-messages mt-4"></div>
        </div>

        <!-- Contact Information -->
        <div class="form-footer mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-600 mb-2">
                <?php esc_html_e('Need immediate assistance? Contact us directly:', 'tznew'); ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6">
                <a href="tel:+977-1-4123456" class="flex items-center space-x-2 text-green-600 hover:text-green-800">
                    <i class="fas fa-phone"></i>
                    <span>+977-1-4123456</span>
                </a>
                <a href="mailto:info@dragonholidays.com" class="flex items-center space-x-2 text-green-600 hover:text-green-800">
                    <i class="fas fa-envelope"></i>
                    <span>info@dragonholidays.com</span>
                </a>
                <a href="https://wa.me/9771234567890" class="flex items-center space-x-2 text-green-600 hover:text-green-800">
                    <i class="fab fa-whatsapp"></i>
                    <span><?php esc_html_e('WhatsApp', 'tznew'); ?></span>
                </a>
            </div>
        </div>
    </form>
</div>

<style>
.form-input:focus {
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
}

.form-group.error .form-input {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.form-group.success .form-input {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.error-message {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>