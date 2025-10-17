import { motion } from 'framer-motion';
import {
  spinnerStyles,
  overlayStyles,
  loadingTextStyles,
  loadingContainerStyles,
  loadingDotsStyles,
  loadingDotStyles,
  shimmerStyles,
  skeletonContentStyles
} from '../utils/styles';
import { pulseAnimation } from '../utils/animations';

const LoadingSpinner = ({ size = 'md', className = '' }) => {
  return (
    <div className={`inline-flex ${className}`}>
      <motion.div
        className={`${spinnerStyles[size]} rounded-full`}
        animate={{ rotate: 360 }}
        transition={{
          duration: 1,
          repeat: Infinity,
          ease: 'linear'
        }}
      />
    </div>
  );
};

const LoadingScreen = ({ message = 'Memuat...' }) => {
  return (
    <motion.div
      className={`${overlayStyles} flex items-center justify-center`}
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      transition={{ duration: 0.3 }}
    >
      <motion.div
        className={`${loadingContainerStyles} flex-col`}
        initial={{ scale: 0.8, opacity: 0 }}
        animate={{ scale: 1, opacity: 1 }}
        transition={{ delay: 0.1, duration: 0.3 }}
      >
        <LoadingSpinner size="xl" />
        <motion.p
          className={loadingTextStyles}
          initial={{ opacity: 0, y: 10 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.2, duration: 0.3 }}
        >
          {message}
        </motion.p>
      </motion.div>
    </motion.div>
  );
};

const LoadingDots = ({ className = '' }) => {
  return (
    <div className={`${loadingDotsStyles} ${className}`}>
      {[0, 1, 2].map((index) => (
        <motion.div
          key={index}
          className={loadingDotStyles}
          animate={{
            scale: [1, 1.2, 1],
            opacity: [0.7, 1, 0.7]
          }}
          transition={{
            duration: 1,
            repeat: Infinity,
            delay: index * 0.2,
            ease: 'easeInOut'
          }}
        />
      ))}
    </div>
  );
};

const LoadingCard = ({ className = '' }) => {
  return (
    <motion.div
      className={`bg-white rounded-2xl p-6 shadow-soft ${className}`}
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.3 }}
    >
      <div className="space-y-4">
        <div className={`${skeletonContentStyles.title}`} />
        <div className={`${skeletonContentStyles.lineShort}`} />
        <div className={skeletonContentStyles.paragraph}>
          <div className={skeletonContentStyles.line} />
          <div className={skeletonContentStyles.lineLong} />
        </div>
      </div>
    </motion.div>
  );
};

const LoadingButton = ({ children, loading, loadingText = 'Memuat...', ...props }) => {
  return (
    <motion.button
      {...props}
      disabled={loading || props.disabled}
      className={`${props.className} ${loading ? 'cursor-not-allowed' : ''}`}
      whileHover={!loading ? { scale: 1.02 } : {}}
      whileTap={!loading ? { scale: 0.98 } : {}}
    >
      {loading ? (
        <motion.div
          className="flex items-center gap-2"
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
        >
          <LoadingSpinner size="sm" />
          <span>{loadingText}</span>
        </motion.div>
      ) : (
        children
      )}
    </motion.button>
  );
};

const ShimmerEffect = ({ className = '' }) => {
  return (
    <motion.div
      className={`${shimmerStyles} ${className}`}
      animate={{
        backgroundPosition: ['-200% 0', '200% 0']
      }}
      transition={{
        duration: 1.5,
        repeat: Infinity,
        ease: 'linear'
      }}
    />
  );
};

const SkeletonLoader = ({ lines = 3, className = '' }) => {
  return (
    <div className={`space-y-3 ${className}`}>
      {Array.from({ length: lines }).map((_, index) => (
        <motion.div
          key={index}
          className={`${skeletonContentStyles.line} ${
            index === 0 ? skeletonContentStyles.title :
            index === lines - 1 ? skeletonContentStyles.lineShort :
            skeletonContentStyles.line
          }`}
          animate={{
            opacity: [0.5, 1, 0.5]
          }}
          transition={{
            duration: 1.5,
            repeat: Infinity,
            delay: index * 0.2,
            ease: 'easeInOut'
          }}
        />
      ))}
    </div>
  );
};

export {
  LoadingSpinner,
  LoadingScreen,
  LoadingCard,
  LoadingButton,
  LoadingDots,
  ShimmerEffect,
  SkeletonLoader
};
