import { motion } from 'framer-motion';

const AnimatedSection = ({ children, delay = 0, className = '', transition = {}, ...rest }) => (
  <motion.section
    {...rest}
    className={className}
    initial={{ opacity: 0, y: 32 }}
    whileInView={{ opacity: 1, y: 0 }}
    viewport={{ once: true, amount: 0.2 }}
    transition={{ delay, duration: 0.6, ease: [0.22, 1, 0.36, 1], ...transition }}
  >
    {children}
  </motion.section>
);

export default AnimatedSection;
