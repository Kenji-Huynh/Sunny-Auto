import React from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'framer-motion';
import { useRef } from 'react';

/**
 * FadeInSection Component
 * 
 * Wrapper component that animates children with fade-in effect when scrolling into view
 * 
 * Usage:
 * <FadeInSection>
 *   <YourContent />
 * </FadeInSection>
 */
const FadeInSection = ({ 
    children, 
    delay = 0,
    duration = 0.6,
    direction = 'up', // 'up', 'down', 'left', 'right', 'none'
    amount = 0.2, // Trigger when 20% visible
    once = true // Animation triggers only once
}) => {
    const ref = useRef(null);
    const isInView = useInView(ref, { 
        once: once,
        amount: amount 
    });

    // Direction variants
    const directionOffset = {
        up: { y: 40 },
        down: { y: -40 },
        left: { x: 40 },
        right: { x: -40 },
        none: {}
    };

    return (
        <motion.div
            ref={ref}
            initial={{ 
                opacity: 0,
                ...directionOffset[direction]
            }}
            animate={isInView ? { 
                opacity: 1,
                x: 0,
                y: 0
            } : {}}
            transition={{ 
                duration: duration,
                delay: delay,
                ease: [0.25, 0.1, 0.25, 1.0] // Custom easing
            }}
        >
            {children}
        </motion.div>
    );
};

export default FadeInSection;


