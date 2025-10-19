/**
 * API utility functions for communicating with PHP backend
 */

const API_BASE_URL = '/api';

class ApiError extends Error {
    constructor(message, status) {
        super(message);
        this.status = status;
    }
}

const apiRequest = async (endpoint, options = {}) => {
    const url = `${API_BASE_URL}${endpoint}`;

    const config = {
        headers: {
            'Content-Type': 'application/json',
            ...options.headers,
        },
        ...options,
    };

    try {
        const response = await fetch(url, config);

        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new ApiError(errorData.error || `HTTP error! status: ${response.status}`, response.status);
        }

        return await response.json();
    } catch (error) {
        if (error instanceof ApiError) {
            throw error;
        }
        throw new ApiError('Network error or server unavailable', 0);
    }
};

export const api = {
    // Services
    async getServices() {
        return apiRequest('/services');
    },

    async getService(id) {
        return apiRequest(`/services/${id}`);
    },

    // Portfolio
    async getPortfolio() {
        return apiRequest('/portfolio');
    },

    // Testimonials
    async getTestimonials() {
        return apiRequest('/testimonials');
    },

    // Categories
    async getCategories() {
        return apiRequest('/categories');
    },

    // Contact form
    async submitContact(data) {
        return apiRequest('/contact', {
            method: 'POST',
            body: JSON.stringify(data),
        });
    },

    // Booking
    async submitBooking(data) {
        return apiRequest('/booking', {
            method: 'POST',
            body: JSON.stringify(data),
        });
    },

    // Available slots for booking
    async getAvailableSlots(serviceId, date) {
        const params = new URLSearchParams({ service_id: serviceId, date });
        return apiRequest(`/available-slots?${params}`);
    },
};

export default api;
