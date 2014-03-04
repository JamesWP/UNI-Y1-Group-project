SELECT u.userID, sum(r.correct) as total from User as u
join Quiz as q on q.userID = u.userID
join Result as r on r.quizID = q.quizID
order by sum(r.correct) desc