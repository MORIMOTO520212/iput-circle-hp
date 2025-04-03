// wp_nonce要素を挿入するコンポーネント

export function WpNonce({ nonceHtml }: { nonceHtml: string }) {
  return <span dangerouslySetInnerHTML={{ __html: nonceHtml }}></span>;
}
