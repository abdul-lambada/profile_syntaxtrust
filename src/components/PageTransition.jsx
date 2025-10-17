import { motion, AnimatePresence } from 'framer-motion';
import { LoadingScreen } from './Loading';
import { pageTransition } from '../utils/animations';

const PageTransition = ({
  children,
  loading = false,
  loadingMessage = 'Memuat...',
  className = ''
}) => {
  return (
    <motion.div
      className={`min-h-screen ${className}`}
      {...pageTransition}
    >
      <AnimatePresence mode="wait">
        {loading ? (
          <LoadingScreen key="loading" message={loadingMessage} />
        ) : (
          <motion.div
            key="content"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            transition={{ duration: 0.4 }}
          >
            {children}
          </motion.div>
        )}
      </AnimatePresence>
    </motion.div>
  );
};

export default PageTransition;
