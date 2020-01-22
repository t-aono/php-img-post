function edit() {

  comment = window.prompt("コメントを入力してください。", "");
  comment = comment.trim();

  if (comment != "" && comment != null && typeof comment !== 'undefined') {
    return comment;
  } else {
    return false;
  }
}