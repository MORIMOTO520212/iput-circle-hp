<!-- アカウント作成フォーム コンポーネント -->
<style>
    .signup-form {
        background: #fff;
        border-radius: 12px;
    }
    .signup-form > :nth-child(n) {
        margin-top: 1rem;
    }
</style>
<form action="" method="post" class="d-flex flex-column p-5 signup-form">
    <div class="mt-0">
        <label for="username">ユーザー名</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="ユーザー名" aria-label="ユーザー名" aria-describedby="username-help">
        <div class="form-text" id="username-help">投稿者の名前として公開されます</div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 gy-2 gy-md-0">
        <div class="col">
            <label for="lastname">姓</label>
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="姓" aria-label="姓" aria-describedby="lastname-help">
            <div class="form-text" id="lastname-help">Last name</div>
        </div>
        <div class="col">
            <label for="firstname">名</label>
            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="名" aria-label="名" aria-describedby="firstname-help">
            <div class="form-text" id="firstname-help">First name</div>
        </div>
    </div>
    <div>
        <label for="email">メールアドレス</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="メールアドレス" aria-label="メールアドレス" aria-describedby="email-help">
        <div class="form-text" id="email-help">大学のメールアドレス</div>
    </div>
    <div>
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="パスワード" aria-label="パスワード" aria-describedby="password-help">
        <div class="form-text" id="password-help">半角英字、数字、記号を組み合わせて 8 文字以上で入力してください</div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <button type="submit" name="signup" class="btn btn-success" value="signup">アカウント作成</button>
    </div>
</form>