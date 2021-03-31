let magic = new Magic(magic_wp.publishable_key_0);
let authorized = false;
const authorizedTemplate = magicSettings.templates.authorized;
const unauthorizedTemplate = magicSettings.templates.unauthorized;

// Magic Sign-in
const MagicSignIn = async () => {
  html = "";
  email = "";
  // profile =
  //   "<p>william.o'reilly@prudential.com</p><p>Prudential Financial</p><p>Director, Stable Value</p><p>Voting Member:</p><p>Board Member:</p><p>Work Phone:</p><p>Cell Phone:</p>";

  const userMetadata = await magic.user.getMetadata();

  if (window.location.pathname === magic_wp.redirect_uri_0) {
    try {
      await magic.auth.loginWithCredential();
      html = authorizedTemplate;
    } catch {
      window.location.href = window.location.origin;
    }
  } else {
    const isLoggedIn = await magic.user.isLoggedIn();
    html = unauthorizedTemplate;
    if (isLoggedIn) {
      html = authorizedTemplate;
    }
  }

  if (document.getElementById("magic-sign-in")) {
    document.querySelector("#magic-sign-in").innerHTML = html;
    document.querySelector("#magic-user-email").innerHTML = email;
  }
};

/* Login Handler */
const handleLogin = async (e) => {
  e.preventDefault();
  const email = new FormData(e.target).get("email");
  const redirectURI = `${window.location.origin + magic_wp.redirect_uri_0}`;
  if (email) {
    await magic.auth.loginWithMagicLink({ email, redirectURI });
    render();
  }
};

/* Logout Handler */
const handleLogout = async () => {
  await magic.user.logout();
  render();
};

document.addEventListener("DOMContentLoaded", function (event) {
  if (jQuery("#magic-sign-in").length > 0) {
    MagicSignIn();
  }
});

// Magic Private
const MagicPrivate = async () => {
  let html = "";

  const isLoggedIn = await magic.user.isLoggedIn();
  if (!isLoggedIn) {
    html = unauthorizedTemplate;
  }

  if (document.getElementById("magic-private")) {
    document.querySelector("#magic-private").innerHTML = html;
  }
};

document.addEventListener("DOMContentLoaded", function (event) {
  if (jQuery("#magic-private").length > 0) {
    return MagicPrivate();
  }
});
