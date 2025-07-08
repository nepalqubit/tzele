<?php
/**
 * Booking Form Template
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
$cost_info = get_field('cost_info', $post_id);
$price = $cost_info['price_usd'] ?? 0;
?>

<div class="booking-form-container bg-white rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">
    <div class="form-header text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
            <i class="fas fa-calendar-check text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2"><?php esc_html_e('Book Your Adventure', 'tznew'); ?></h2>
        <?php if ($post_title) : ?>
            <p class="text-lg text-gray-600"><?php echo esc_html($post_title); ?></p>
            <?php if ($price > 0) : ?>
                <div class="text-2xl font-bold text-blue-600 mt-2">$<?php echo esc_html(number_format($price)); ?> <?php esc_html_e('per person', 'tznew'); ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <form id="booking-form" class="booking-form space-y-6" method="post" novalidate>
        <?php wp_nonce_field('tznew_booking_nonce', 'booking_nonce'); ?>
        
        <!-- Hidden fields -->
        <input type="hidden" name="action" value="tznew_submit_booking">
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
        <input type="hidden" name="post_title" value="<?php echo esc_attr($post_title); ?>">
        <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">

        <!-- Personal Information -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user mr-2 text-blue-500"></i>
                <?php esc_html_e('Personal Information', 'tznew'); ?>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="first_name" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('First Name', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first_name" name="first_name" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="form-group">
                    <label for="last_name" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Last Name', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="last_name" name="last_name" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="form-group">
                    <label for="email" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Email Address', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Phone Number', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="phone" name="phone" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label for="country" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Country', 'tznew'); ?> <span class="text-red-500">*</span>
                </label>
                <select id="country" name="country" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" required>
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
                <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
            </div>
        </div>

        <!-- Trip Details -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-mountain mr-2 text-green-500"></i>
                <?php esc_html_e('Trip Details', 'tznew'); ?>
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="preferred_date" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Preferred Start Date', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="preferred_date" name="preferred_date" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" min="<?php echo esc_attr(date('Y-m-d', strtotime('+1 week'))); ?>" required>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="form-group">
                    <label for="group_size" class="form-label block text-sm font-medium text-gray-700 mb-2">
                        <?php esc_html_e('Number of Travelers', 'tznew'); ?> <span class="text-red-500">*</span>
                    </label>
                    <select id="group_size" name="group_size" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" required>
                        <option value=""><?php esc_html_e('Select group size', 'tznew'); ?></option>
                        <?php for ($i = 1; $i <= 20; $i++) : ?>
                            <option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($i . ($i === 1 ? ' person' : ' people')); ?></option>
                        <?php endfor; ?>
                    </select>
                    <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label for="accommodation_preference" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Accommodation Preference', 'tznew'); ?>
                </label>
                <select id="accommodation_preference" name="accommodation_preference" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    <option value=""><?php esc_html_e('No preference', 'tznew'); ?></option>
                    <option value="budget"><?php esc_html_e('Budget (Tea houses/Basic lodges)', 'tznew'); ?></option>
                    <option value="standard"><?php esc_html_e('Standard (Comfortable lodges)', 'tznew'); ?></option>
                    <option value="luxury"><?php esc_html_e('Luxury (Premium hotels/lodges)', 'tznew'); ?></option>
                </select>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="form-section">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle mr-2 text-purple-500"></i>
                <?php esc_html_e('Additional Information', 'tznew'); ?>
            </h3>
            
            <div class="form-group">
                <label for="dietary_requirements" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Dietary Requirements', 'tznew'); ?>
                </label>
                <textarea id="dietary_requirements" name="dietary_requirements" rows="3" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" placeholder="<?php esc_attr_e('Please mention any dietary restrictions, allergies, or special requirements...', 'tznew'); ?>"></textarea>
            </div>
            
            <div class="form-group mt-4">
                <label for="special_requests" class="form-label block text-sm font-medium text-gray-700 mb-2">
                    <?php esc_html_e('Special Requests or Questions', 'tznew'); ?>
                </label>
                <textarea id="special_requests" name="special_requests" rows="4" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300" placeholder="<?php esc_attr_e('Any special requests, questions, or additional information you\'d like to share...', 'tznew'); ?>"></textarea>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="form-section">
            <div class="flex items-start space-x-3">
                <input type="checkbox" id="terms_agreement" name="terms_agreement" class="mt-1 w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                <label for="terms_agreement" class="text-sm text-gray-700">
                    <?php esc_html_e('I agree to the', 'tznew'); ?> 
                    <a href="#" class="text-blue-600 hover:text-blue-800 underline"><?php esc_html_e('Terms and Conditions', 'tznew'); ?></a> 
                    <?php esc_html_e('and', 'tznew'); ?> 
                    <a href="#" class="text-blue-600 hover:text-blue-800 underline"><?php esc_html_e('Privacy Policy', 'tznew'); ?></a>
                    <span class="text-red-500">*</span>
                </label>
            </div>
            <div class="error-message text-red-500 text-sm mt-1 hidden"></div>
        </div>

        <!-- Submit Button -->
        <div class="form-submit pt-6">
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane"></i>
                <span><?php esc_html_e('Submit Booking Request', 'tznew'); ?></span>
            </button>
            
            <div class="form-loading hidden mt-4 text-center">
                <div class="inline-flex items-center space-x-2 text-blue-600">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-600"></div>
                    <span><?php esc_html_e('Submitting your request...', 'tznew'); ?></span>
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
                <a href="tel:+977-1-4123456" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-phone"></i>
                    <span>+977-1-4123456</span>
                </a>
                <a href="mailto:info@dragonholidays.com" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800">
                    <i class="fas fa-envelope"></i>
                    <span>info@dragonholidays.com</span>
                </a>
            </div>
        </div>
    </form>
</div>

<style>
.form-input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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