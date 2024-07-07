<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to the Dashboard</h2>
    <form method="post">
    <div class="select-wrapper">
    <div class="custom-select" style="width:200px;">
        <select id="course" name="course">
            <option selected>Select Course</option>
            <option value="bba">BBA</option>
            <option value="bca">BCA</option>
            <option value="mba">MBA</option>
            <option value="mca">MCA</option>
        </select>
        
    </div>
    </div>
    <button class="button-64" role="button" type="submit" name="submit"><span class="text">Go</span></button>
    </form>

    <script src="script2.js"></script>
    <?php
    if (isset($_POST['submit'])) {
        $course = $_POST['course'];

        // Database connection
        $conn = new mysqli("localhost", "root", "", "tt");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch timetable data based on selected course
        if ($course === 'bca') {
            $table = "BCA_Timetable";
            $courseName = "BCA";
        } elseif ($course === 'bba') {
            $table = "BBA_Timetable";
            $courseName = "BBA";
        } elseif ($course === 'mba') {
            $table = "MBA_Timetable";
            $courseName = "MBA";
        } elseif ($course === 'mca') {
            $table = "MCA_Timetable";
            $courseName = "MCA";
        }

        if ($table) {
            $sql = "SELECT * FROM $table";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h3>$courseName Timetable</h3>";
                echo "<table class='custom-table'>";
                echo "<tr>
                        <th>Class Day</th>
                        <th>Class Time</th>
                        <th>Class Name</th>
                        <th>Faculty Name</th>
                      </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["ClassDay"]."</td>
                            <td>".$row["ClassTime"]."</td>
                            <td>".$row["ClassName"]."</td>
                            <td>".$row["FacultyName"]."</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No timetable data available for $courseName.";
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>