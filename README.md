# تست کد مصاحبه دکتر تو!

## ساختار دیتابیس
در این پروژه از  ۴ جدول استفاده شده

- users
- wallets
- discount_codes
- discount_histories

**جدول users**
| id | name | mobile |
|--|--|--|
| int| string, nullable | string, unique index |


**جدول wallets**
| id | user_id | deposit | withdraw | balance |
|--|--|--|--|--|
| int | int, index | int, default 0 | int, default 0 | int, default 0 |


**جدول discount_codes**
| id | code | number_used |
|--|--|--|
| int | string, 10, index | int, default 0 |


**جدول discount_histories**
| id | discount_code_id | user_id |
|--|--|--|
| int | int, index | int, index |

## فایل ها
به ازای هر جدول فایل های زیر ایجاد شدند
- UnitTest
- FeatureTest
- Model
- Migration
- Request
- Resource
- Controller
- Factory

همینطور به ازای هر مدل تغییراتی در فایل های زیر بوجود آمد
- routes/api.php
- resources/lang/en/messages.php

## نصب و اجرا

1. از دستور git clone https://github.com/hamidreza-mozhdeh/doctoreto-techtest.git برای دریافت پروژه استفاده کنید
2. فایل .env.example را کپی کنید و تغییر نام دهید به .env
3. دستور composer update را در داخل فولدر پروژه اجرا کنید
4. دستور php artisan migrate را اجرا کنید
5. دستور php artisan serve را اجرا کنید
6. به آدرس http://127.0.0.1:8000/api/documentation بروید


برای تست و اجرای کد ابتدا مراحل زیر را به ترتیب دنبال کنید

1. یک کاربر بسازید
2. کد تخفیف را بسازید
3. کد تخفیف را اعمال کنید

