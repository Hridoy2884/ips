/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './node_modules/preline/**/*.js', // ✅ Correct path
    './resources/**/*.blade.php',
    './resources/**/*.js',
    
  ],
  theme: {
    
   
  },
  plugins: [
    //require('preline/plugin'), // ✅ Ensure this line works only after installation
  ],
  darkMode: 'class', // Enable dark mode

}


