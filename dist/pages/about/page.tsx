import { createRoot } from "react-dom/client";
import { useProps } from "../../hooks/useProps";

type TextField = string | undefined;

type DefaultProps = {
  themeFileUri: string;
};

type Props = {
  title: TextField;
  userId: TextField;
  userName: TextField;
  firstName: TextField;
  lastName: TextField;
  displayName: TextField;
  email: TextField;
  nonceHtml: string;
} & DefaultProps;

const Page = () => {
  const props = useProps<Props>();

  return (
    <div className="main mx-2 mb-5">
      <h2 className="txt-subject text-center">{props.title}</h2>
      <form
        id="profile"
        className="form-loading container row-cols-1 g-3 mb-5 max-width-sm"
        action=""
        method="post"
        noValidate
        style={{ padding: "30px 40px" }}
      >
        <div className="form-floating mb-3">
          <input
            type="text"
            className="form-control"
            id="username"
            value={props.userName}
            disabled
          />
          <label htmlFor="username">ユーザー名（変更できません）</label>
        </div>
        <div className="form-floating mb-3">
          <input
            type="text"
            className="form-control"
            id="displayname"
            placeholder=""
            name="displayname"
            value={props.displayName}
            disabled
          />
          <label htmlFor="displayname">表示名</label>
        </div>
        <div className="wrapper-name" style={{ width: "100%" }}>
          <div className="form-floating mb-3" style={{ width: "49%" }}>
            <input
              type="text"
              autoComplete="family-name"
              className="form-control"
              id="lastname"
              placeholder=""
              name="lastname"
              value={props.lastName}
              disabled
            />
            <label htmlFor="lastname">姓</label>
          </div>
          <div className="form-floating mb-3" style={{ width: "49%" }}>
            <input
              type="text"
              autoComplete="given-name"
              className="form-control"
              id="firstname"
              placeholder=""
              name="firstname"
              value={props.firstName}
              disabled
            />
            <label htmlFor="firstname">名</label>
          </div>
        </div>
        <div className="form-floating mb-3">
          <input
            type="email"
            className="form-control"
            id="email"
            value={props.email}
            disabled
          />
          <label htmlFor="email">メールアドレス（変更できません）</label>
        </div>
        <div className="form-floating mb-3">
          <input
            type="password"
            className="form-control"
            id="password"
            placeholder=""
            name="password"
            value=""
            disabled
          />
          <label htmlFor="password">新しいパスワード</label>
        </div>

        <span dangerouslySetInnerHTML={{ __html: props.nonceHtml }}></span>

        <div className="d-flex justify-content-end mb-3">
          <button
            id="edit"
            className="btn btn-success"
            type="submit"
            name="submit_type"
            value="profile"
          >
            編集する
          </button>
        </div>

        <div className="mb-5">
          <p className="mb-2 fw-bold">アカウント連携</p>
          <a
            href="https://discord.com/oauth2/authorize?client_id=1250622307618132019"
            className="discord-button mb-2"
          >
            <img src={`${props.themeFileUri}/src/Discord-Symbol-White.svg`} />
            <p className="text-white">Discordと連携する</p>
          </a>
          <small className="d-block">
            IPUT ONEのアカウントをDiscordアカウントと連携することで、IPUT
            ONEのさまざまな機能をDiscordで使うことができます。
          </small>
        </div>

        <div className="d-flex justify-content-between">
          <button
            type="button"
            className="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#accountDel"
          >
            アカウントを削除する
          </button>
          <a className="btn btn-warning" href="./?t=logout" role="button">
            ログアウトする
          </a>
        </div>
        <small className="text-secondary">一度削除すると元に戻せません</small>
      </form>
    </div>
  );
};

const page = createRoot(document.getElementById("aboutPage"));
page.render(<Page />);
