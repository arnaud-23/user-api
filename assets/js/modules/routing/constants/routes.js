const webappRoutes = {
    HOME: '/',
    // ABOUT_US: {
    //     INDEX: '/about-us',
    // },
    // POLICIES: {
    //     TERMS_CONDITION: '/terms-conditions',
    //     TERMS_SALES: '/terms-of-sale',
    //     PRIVACY_POLICY: '/privacy-policy',
    //     INTERNAL_STUDENTS_RULES: '/internal-rules-for-students',
    //     LEGAL_INFORMATION: '/legal-information',
    // },
    AUTHENTICATION: {
        LOGIN: '/login',
        REGISTER: '/register',
    },
    SECURITY: {
        RESET_PASSWORD: '/reset-password',
        // GENERATE_PASSWORD: '/generate-password',
        // CONFIRM_PASSWORD: '/confirm-new-password/:userId',
    },
    ERRORS: {
        // ERROR403: '/errors/403',
        ERROR404: '/errors-404',
        // ERROR410: '/errors/410',
        // ERROR500: '/errors/500',
    },
};

export default Object.freeze({ ...webappRoutes, });
