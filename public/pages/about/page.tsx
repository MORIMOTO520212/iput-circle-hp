import { createRoot } from "react-dom/client";

const Page = () => {
  return (
    <div className="main mx-2 mb-5">
      <h2 className="txt-subject text-center">アカウント情報</h2>
    </div>
  );
};

const aboutPage = createRoot(document.getElementById("aboutPage"));
aboutPage.render(<Page />);
