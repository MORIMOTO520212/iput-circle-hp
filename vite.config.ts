import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import tsconfigPaths from 'vite-tsconfig-paths';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  server: {
    port: 3000, // ここでポート番号を指定します
  },
  build: {
    rollupOptions: {
      output: {
        entryFileNames: 'assets/bundle.js',
        assetFileNames: 'assets/[name][extname]',
      },
    },
  },
  plugins: [react(), tsconfigPaths(), tailwindcss()],
});
