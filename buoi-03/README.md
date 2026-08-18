# Buổi 03

## Bài tập trên lớp

- Bài 01: [Form liên hệ](./bai-tap-tren-lop/bai-01/form-lien-he.php)

## Nội dung Bài 01

- Nhập họ tên, email, chủ đề và nội dung liên hệ.
- Kiểm tra họ tên không được để trống và nội dung phải có từ 10 đến 500 ký tự.
- Kiểm tra email đúng định dạng.
- Yêu cầu người dùng chọn ảnh đại diện.
- Kiểm tra tệp tải lên phải là ảnh JPG, PNG, GIF hoặc WEBP và không lớn hơn 2 MB.
- Lưu ảnh hợp lệ vào thư mục `uploads` với tên tệp mới để tránh trùng tên.
- Giữ lại dữ liệu đã nhập nếu form có lỗi.
- Hiển thị thông báo khi gửi liên hệ thành công.

## Bài tập về nhà

- [Form đăng nhập an toàn](./bai-tap-ve-nha/dang-nhap-an-toan.php)

### Nội dung

- Kiểm tra email và mật khẩu bắt buộc ở phía server.
- Email phải đúng định dạng và không quá 254 ký tự.
- Mật khẩu phải có từ 8 đến 72 ký tự.
- Chuẩn hóa email bằng cách xóa khoảng trắng và chuyển về chữ thường.
- Hiển thị lỗi tại trường tương ứng và giữ lại email khi form có lỗi.
- Không điền lại mật khẩu khi form có lỗi.
- Mã hóa dữ liệu khi hiển thị bằng `htmlspecialchars()` để hạn chế XSS.
- Kiểm tra mật khẩu mẫu bằng `password_verify()` và lưu trạng thái bằng session
  trong thư mục tạm của hệ điều hành.
- Chưa sử dụng cơ sở dữ liệu theo yêu cầu Buổi 3.

Tài khoản thử nghiệm:

```text
Email: admin@storyhub.vn
Mật khẩu: Admin@123
```
