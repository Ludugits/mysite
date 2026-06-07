export function Logo({ size = 44 }: { size?: number }) {
  return (
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 64 64"
      width={size}
      height={size}
      style={{ borderRadius: 8, flexShrink: 0 }}
    >
      <defs>
        <linearGradient id="raGrad" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stopColor="#d97706" />
          <stop offset="100%" stopColor="#b45309" />
        </linearGradient>
      </defs>
      <rect width="64" height="64" rx="12" fill="url(#raGrad)" />
      {/* Контур автомобиля */}
      <path 
        d="M18 36 C18 28 20 26 24 26 L38 26 C41 26 44 28 46 31 L50 31 C52 31 53 32 53 34 L53 37 C53 38 52 39 50 39 C49 35 44 35 43 39 L27 39 C26 35 21 35 20 39 L19 39 C18 39 18 38 18 36 Z" 
        fill="none" 
        stroke="white" 
        strokeWidth="3.5" 
        strokeLinecap="round" 
        strokeLinejoin="round" 
      />
      {/* Колеса */}
      <circle cx="23.5" cy="39" r="3" fill="none" stroke="white" strokeWidth="3.5" />
      <circle cx="46.5" cy="39" r="3" fill="none" stroke="white" strokeWidth="3.5" />
    </svg>
  );
}
