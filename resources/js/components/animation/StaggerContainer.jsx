import React from 'react';
import { motion } from 'framer-motion';

/**
 * StaggerContainer Component
 * 
 * Container that staggers the animation of its children
 * Each child will animate with a slight delay after the previous one
 * 
 * Usage:
 * <StaggerContainer>
 *   <div>Item 1</div>
 *   <div>Item 2</div>
 *   <div>Item 3</div>
 * </StaggerContainer>
 */
const StaggerContainer = ({ 
    children,
    staggerDelay = 0.1,
    initialDelay = 0
}) => {
    const containerVariants = {
        hidden: { opacity: 0 },
        visible: {
            opacity: 1,
            transition: {
                delayChildren: initialDelay,
                staggerChildren: staggerDelay
            }
        }
    };

    const itemVariants = {
        hidden: { 
            opacity: 0,
            y: 20
        },
        visible: {
            opacity: 1,
            y: 0,
            transition: {
                duration: 0.5,
                ease: [0.25, 0.1, 0.25, 1.0]
            }
        }
    };

    return (
        <motion.div
            variants={containerVariants}
            initial="hidden"
            whileInView="visible"
            viewport={{ once: true, amount: 0.2 }}
        >
            {React.Children.map(children, (child, index) => (
                <motion.div key={index} variants={itemVariants}>
                    {child}
                </motion.div>
            ))}
        </motion.div>
    );
};

export default StaggerContainer;

