export const useProps = <T>(): T => {
  return JSON.parse(document.getElementById("__REACT_DATA__").textContent);
};
