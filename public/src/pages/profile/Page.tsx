import { createRoot } from 'react-dom/client';
import { useProps } from '../../hooks/useProps';
import { WpNonce } from '../../components/WpNonce';
import { useActionState, useState } from 'react';
import { getFormProps, getInputProps, useForm } from '@conform-to/react';
import { getZodConstraint, parseWithZod } from '@conform-to/zod';
import { profileFormSchema } from '../../features/profile/types';
import '@/globals.css';

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

function Page() {
  const props = useProps<Props>();
  const [isEditable, setIsEditable] = useState<boolean>(false);

  const onSubmit = (postData) => {
    console.log(postData);
    // fetch('/profile', {
    //   method: 'POST',
    //   body: JSON.stringify({
    //     displayname: postData.displayname,
    //     lastname: postData.lastname,
    //     password: postData.password,
    //     submit_type: postData.submit_type
    //   }),
    // });
  };

  const [lastResult, action, isPending] = useActionState(onSubmit, undefined);

  const [form, fields] = useForm({
    constraint: getZodConstraint(profileFormSchema),
    lastResult,
    defaultNoValidate: true,
    shouldValidate: 'onInput',
    defaultValue: {
      displayName: props.displayName,
      lastName: props.lastName,
      firstName: props.firstName,
      password: undefined,
    },
    onValidate({ formData }) {
      return parseWithZod(formData, { schema: profileFormSchema });
    },
  });

  return (
    <div className="main mx-2 mb-5">
      <h2 className="txt-subject text-center">{props.title}</h2>
      <form
        id="profile"
        className="form-loading container row-cols-1 g-3 mb-5 max-width-sm"
        {...getFormProps(form)}
        action={action}
        style={{ padding: '30px 40px' }}
      >
        <div className="form-floating mb-3">
          <input
            type="text"
            className="form-control"
            value={props.userName}
            disabled
          />
          <label htmlFor="username">ユーザー名（変更できません）</label>
        </div>
        {/* 氏名 */}
        <div className="form-floating mb-3">
          <input
            className="form-control"
            {...getInputProps(fields.displayName, { type: 'text' })}
            disabled={!isEditable}
          />
          <label htmlFor="displayname">表示名</label>
        </div>
        <div className="d-flex gap-2">
          <div className="form-floating mb-3" style={{ width: '49%' }}>
            <input
              className="form-control"
              {...getInputProps(fields.lastName, { type: 'text' })}
              disabled={!isEditable}
            />
            <label htmlFor="lastname">姓</label>
          </div>
          <div className="form-floating mb-3" style={{ width: '49%' }}>
            <input
              className="form-control"
              {...getInputProps(fields.firstName, { type: 'text' })}
              disabled={!isEditable}
            />
            <label htmlFor="firstname">名</label>
          </div>
        </div>
        <div>
          {!!fields.lastName.errors || !!fields.firstName.errors ? (
            <p>{fields.lastName.errors}</p>
          ) : null}
        </div>
        {/* メールアドレス */}
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
        {/* パスワード */}
        <div className="form-floating mb-3">
          <input
            className="form-control"
            {...getInputProps(fields.password, { type: 'text' })}
            disabled={!isEditable}
          />
          <label htmlFor="password">新しいパスワード</label>
        </div>

        <WpNonce nonceHtml={props.nonceHtml} />

        <div className="d-flex justify-content-end mb-3">
          <button
            id="edit"
            type={isEditable ? 'submit' : 'button'}
            className="btn btn-success"
            onClick={() => setIsEditable(true)}
          >
            {isEditable ? '確定する' : '編集する'}
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
}

const page = createRoot(document.getElementById('profilePage'));
page.render(<Page />);
