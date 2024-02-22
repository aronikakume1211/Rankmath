import { useState, useEffect } from "@wordpress/element";
import {
  CartesianGrid,
  Line,
  LineChart,
  Tooltip,
  XAxis,
  YAxis,
} from "recharts";
import apiFetch  from "@wordpress/api-fetch";
import { SelectControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

const Dashboard = () => {
  const [posts, setPosts] = useState([]);
  const [value, setValue] = useState(7); // default value is 7 days

  const getPosts = async (days) => {
    try {
      const res = await apiFetch({ path: `/rankmath/v1/employees/?days=${days}` });
      setPosts(res);
    } catch (error) {
      console.error("Error fetching posts:", error);
    }
  };
 
  useEffect(() => {
    getPosts(7);
  }, []);

  const handleChange = (newValue) => {
    setValue(newValue);
    getPosts(newValue);
  };

  return (
    <div>
      <div className="chart-header">
        <h2>{__("Graph Widget", "rank-math")}</h2>

        <SelectControl
          value={value}
          onChange={handleChange}
          options={[
            { label: __("Last 7 days", "rank-math"), value: "7" },
            { label: __("Last 15 days", "rank-math"), value: "15" },
            { label: __("Last 30 days", "rank-math"), value: "30" },
          ]}
        />
      </div>
      <hr />
      <LineChart
        width={400}
        height={300}
        data={posts}
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
