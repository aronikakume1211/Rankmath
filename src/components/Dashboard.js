import axios from "axios";
import React, { useState, useEffect } from "react";
import {
  CartesianGrid,
  Line,
  LineChart,
  Tooltip,
  XAxis,
  YAxis,
} from "recharts";

const Dashboard = () => {
  const [posts, setPosts] = useState([]);
  const [value, setValue] = useState(7); // default value is 7 days
  let url=`${window.location.origin}/wp-json/rankmath/v1/employees`;
  let results;

  const getPosts = async () => {
    const { data } = await axios.get(url); // axios call and destructure the data
    setPosts(data);
  };

  useEffect(() => {
    getPosts();
  }, []);

  //   Filter the data by the selected value
  const fiteredData = () => {
    results = posts
      .filter((post) => {
        return (
          new Date(post.activedate).getTime() >new Date().getTime() - value * 24 * 60 * 60 * 1000
        );
      })
      .map((post) => {
        return post;
      });
  };

//   init fun call
    fiteredData();

  const handleChange = (e) => {
    let lastDays = parseInt(e.target.value);
    setValue(lastDays);
    fiteredData(); // re-filter the data by the selected value
  };
  return (
    <div>
      <div className="chart-header">
        <h2>Graph Widget</h2>
        <select
          name="rankmath_widget"
          id="rankmath_widget"
          onChange={handleChange}
          value={value}
        >
          <option value="7">Last 7 days</option>
          <option value="15">Last 15 days</option>
          <option value="30">Last 30 days</option>
        </select>
      </div>
      <hr />
      <LineChart
        width={400}
        height={300}
        data={results != '' ? results : posts }
        margin={{ top: 5, right: 10, left: -30, bottom: 5 }}
      >
        <Line type="monotone" dataKey="price" stroke="#8884d8" />
        <CartesianGrid stroke="#ccc" strokeDasharray="5 5" />
        <XAxis dataKey="writer" />
        <YAxis />
        <Tooltip />
      </LineChart>
    </div>
  );
};

export default Dashboard;
