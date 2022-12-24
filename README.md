# Реализация шаблона CRUD
------
## Задание
Разработать и реализовать клиент-серверную информационную систему, реализующую мехнизм CRUD. Система представляет собой веб-страницу с лентой заметок и форму добавления новой заметки. Система должна обладать следующим функционалом:
 - Добавление текстовых заметок в общую ленту
 - Реагирование на чужие заметки (лайки)
 
## Ход работы

### 1) Разработка пользовательского интерфейса

[Пользовательский интерфейс](https://www.figma.com/file/R5sTZRMo1JGB2srim3KWYp/Untitled?node-id=0%3A1&t=5rPowaLivv0hOcEg-0)
![Пользовательский интерфейс](https://github.com/evgeniimarkovskii2003/lab2/blob/main/%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D1%84%D0%B5%D0%B9%D1%812.PNG)

### 2) Описание пользовательских сценариев работы
Пользователь заходит на сайт и попадает на главную страницу. 
У пользователя есть возможности:
- Опубликовать новую запись на форуме.

Для того, чтобы опубликовать новую запись пользователю необходимо ввести текст (от 4 до 900 символов) в поле, в котором написано "Напишите ваш пост", после чего нажать кнопку "отправить".

- Поставить лайк на записи, которые публиковались ранее. 


Пользователю нужно нажать на кнопку с лайком и количество лайков увеличится. Количество реакций не ограничено (до 999).
- Комментировать запись

Чтобы прокомментировать запись, пользователю необходимо нажать на кнопку "Показать комментарии", после чего нужно в поле "Напишите комментарий" написать текст(от 4 до 200 символов), который он бы хотел сделать к этой записи сделать. Нажать на кнопку "Ответить".

- Оставить комментарий к комментарию

Для того, чтобы ответить пользователю, который оставил комментарий необходимо под его комментарием ввести текст в поле (от 4 до 200 символов), в котором написано "Ответить" и нажать на кнопку "Ответить".

- Перемещение по страницам форума и чтение
 
С помощью стрелок можно перемещаться и смотреть новые и старые записи. Нажав на стрелку вправо, пользователь переходит к более старым записям. Если нажата левая стрелка, то пользователь возвращается к более новым записям. При нажатии на "домик", пользователь возвращается на главную старницу.

### 3. Описание API сервера и хореографии

#### Примеры различных запросов:
<img src="https://github.com/evgeniimarkovskii2003/lab2/blob/main/newpost.png"/width = 500>
<img src="https://github.com/evgeniimarkovskii2003/lab2/blob/main/reaction.png"/width = 500>
<img src="https://github.com/evgeniimarkovskii2003/lab2/blob/main/scrollingposts.png"/width = 500>

### 4. Описание структуры базы данных

Для хранения данных форума используется база данных MySQL. Всего в базе данных содержится 3 таблицы: таблица с информацией о записях на форуме, таблица с информацией о комментариях и таблица с информацией о комментариях второго уровня.

Таблица о записях на форуме содержит в себе индивидуальный номер записи, текст записи, количество лайков.

Пример записи на форуме в базе данных:

```sh
{
    "id": 3,
    "text": "Третий пост на форуме",
    "like_count": 5,
    }
```

Таблица о комментариях на форуме содержит в себе индивидуальный номер комментария, текст комментария, индивидуальный номер записи, к которой относится комментарий.

Пример записи о комментарии в базе данных:

```sh
{
    "id": 3,
    "text": "Первый комментарий к этой записи",
    "post_id": 52
}
```

Таблица о комментариях второго уровня на форуме содержит в себе индивидуальный номер комментария, текст комментария, индивидуальный номер комментария, к которому относится комментарий.

Пример записи о комментарии второго уровня в базе данных:

```sh
{
    "id": 1,
    "text": "Первый комментарий 2-го уровня",
    "comment_id": 3
}
```

### 5. Описание алгоритмов

- Пользователь добавляет новую запись с картинкой:
<p align = "center"> <img src="https://github.com/tagathlet/3sem_lr2/blob/main/DiagAlgPosts.png" width = "400"> </p>


- Пользователь оставляет комментарий:
<p align = "center"><img src="https://github.com/tagathlet/3sem_lr2/blob/main/Diag_NewComm.png" width = "400"/></p>


- Пользователь оставляет реакцию:
<p align = "center"><img src="https://github.com/tagathlet/3sem_lr2/blob/main/DiagLike.png" width = "300"/></p>


- Пользователь переключается между страницами:
<p align = "center"><img src="https://github.com/tagathlet/3sem_lr2/blob/main/DiagPages.png" width = "120"/></p>

- Алгоритм выдачи постов:
<p align = "center"><img src="https://github.com/tagathlet/3sem_lr2/blob/main/DiagAlgPosts.png" width = "200"/></p>


## Значимые фрагменты кода
Фрагмент кода, запрашивающий записи о постах из базы данных:
```sh
$link = mysqli_connect("localhost", "admin", "admin", "lab2_bd");

mysqli_set_charset($link, "utf8");

$sql = 'SELECT * FROM posts ORDER BY time DESC';

$result = mysqli_query($link, $sql);
$max_posts = mysqli_num_rows($result);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
```

Фрагмент кода, содержащий скрипты для "раскрывающихся" комментариев
```sh
<script> 
	function show_comments(id){
		let c = document.getElementById("c"+id);
		c.removeAttribute("hidden");
		
		let b = document.getElementById("b"+id);
		b.textContent = "Скрыть комментарии";
		
		b.setAttribute("onClick", "hide_comments('"+id+"')");
	}
	
	function hide_comments(id) {
		let c = document.getElementById("c"+id);
		c.setAttribute("hidden", true);
		
		let b = document.getElementById("b"+id);
		b.textContent = "Показать комментарии";
		
		b.setAttribute("onClick", "show_comments('"+id+"')");
	}
</script>
```

Фрагмент кода выдачи постов: 
```sh
<?php
	$max_page_posts = 100;
				
	$page = 1;
	if (isset($_GET["page"]) && $_GET["page"] > 0)
		$page = $_GET["page"];
			
	if (($page - 1) * $max_page_posts >= $max_posts)
		$page = ceil($max_posts / $max_page_posts); 
			
	for ($i = 1 + ($max_page_posts * ($page - 1)); $i <= ($max_page_posts*$page); $i++) {				
		
		if ($i > $max_posts)
			break;
				
		[$text, $like, $post_id] = parse_post($i - 1, $result);
		[$comments, $comm_count, $c_id, $sub_comm_count] = parse_comment($post_id, $comments_db);
				
		echo "<tr> <td>";
		include ("template/post.php");
		echo "</td></tr>";
				
		echo "<tr height = 5> </tr>";
		echo "<tr><td>";
		include ("template/comments.php"); 
		echo "</td></tr>";
				
		echo "<tr height = 20> <td> <hr> <td> </tr>";
	}
		
?>
```

Фрагмент кода, создающий новую запись о посте в базе данных:
```sh
$sql = "INSERT INTO `posts` (`id`, `text`, `like_count`) VALUES (NULL, '".$text."', '0');";
	
$link = mysqli_connect("localhost", "admin", "admin", "lab2_bd");
mysqli_set_charset($link, "utf8");
$res = mysqli_query($link, $sql);
```
