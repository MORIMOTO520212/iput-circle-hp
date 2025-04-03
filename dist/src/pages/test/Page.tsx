import { createRoot } from "react-dom/client";

function Page() {
  return <div>this is test page</div>;
}

const page = createRoot(document.getElementById("testPage"));
page.render(<Page />);
