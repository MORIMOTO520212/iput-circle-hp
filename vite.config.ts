import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
  server: {
    port: 3000, // ここでポート番号を指定します
  },
  build: {
    rollupOptions: {
      output: {
        entryFileNames: `assets/bundle.js`,
      },
    },
  },
  plugins: [react()],
});
